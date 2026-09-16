<?php

namespace Kanboard\Plugin\Bigboard\Model;

use Kanboard\Core\Base;

/**
 * Optional read-only bridge to PortfolioDashboard project groups.
 *
 * Bigboard remains usable on installations without PortfolioDashboard. The
 * bridge deliberately consumes its public grouping response and then applies
 * Bigboard's already-authorized project IDs, so a group view cannot reveal a
 * project that the current user cannot access.
 */
final class PortfolioGroupScopeModel extends Base
{
    public function getScopes(array $allowedProjectIds): array
    {
        $allowedProjectIds = array_values(array_unique(array_map('intval', $allowedProjectIds)));
        if (empty($allowedProjectIds)) {
            return array();
        }

        $portfolioModelClass = '\\Kanboard\\Plugin\\PortfolioDashboard\\Model\\PortfolioProjectModel';
        if (! class_exists($portfolioModelClass)) {
            return array();
        }

        try {
            $grouping = (new $portfolioModelClass($this->container))->getProjectGrouping();
        } catch (\Throwable $exception) {
            // A partially installed PortfolioDashboard must not prevent the
            // independent Bigboard plugin from rendering its native view.
            return array();
        }

        $allowed = array_fill_keys($allowedProjectIds, true);
        $groups = array();
        foreach ($grouping['groups'] as $group) {
            $groups[(int) $group['id']] = array(
                'key' => 'group:'.(int) $group['id'],
                'name' => $group['name'],
                'position' => (int) $group['position'],
                'project_ids' => array(),
            );
        }

        $ungrouped = array();
        foreach ($grouping['projects'] as $project) {
            $projectId = (int) $project['project_id'];
            if (! isset($allowed[$projectId])) {
                continue;
            }

            if ($project['group_id'] === null) {
                $ungrouped[] = $projectId;
                continue;
            }

            $groupId = (int) $project['group_id'];
            if (isset($groups[$groupId])) {
                $groups[$groupId]['project_ids'][] = $projectId;
            }
        }

        $scopes = array();
        foreach ($groups as $group) {
            if (empty($group['project_ids'])) {
                continue;
            }

            sort($group['project_ids']);
            $scopes[] = $group;
        }

        usort($scopes, static function (array $left, array $right): int {
            return $left['position'] <=> $right['position'];
        });

        if (! empty($ungrouped)) {
            sort($ungrouped);
            $scopes[] = array(
                'key' => 'ungrouped',
                'name' => t('Ungrouped projects'),
                'position' => PHP_INT_MAX,
                'project_ids' => $ungrouped,
            );
        }

        return $scopes;
    }
}

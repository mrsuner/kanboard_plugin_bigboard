# Kanboard Plugin Bigboard

A Kanboard that can display multiple projects.

This software is in maintenance mode. It doesn't mean it's abandoned, but there is no significant feature development. Pull-requests are still accepted as long as the guidelines are followed.

Plugin for <https://github.com/kanboard/kanboard>

## Author

- [BlueTeck](https://github.com/BlueTeck)
- [Pierre Cadeot](https://github.com/pcadeot)
- [PapeCoding](https://github.com/PapeCoding)
- [Chaosmeister](https://github.com/Chaosmeister)
- [Jake G](https://github.com/jieiku)
- based on Bigboard by [Thomas Stinner](https://github.com/stinnux)
- License MIT

## Installation

- Decompress the archive in the `plugins` folder

or

- Create a folder **plugins/Bigboard**
- Copy all files under this directory

## PortfolioDashboard integration

Bigboard works without PortfolioDashboard. When the optional
`PortfolioDashboard` plugin is installed, Bigboard adds a **Portfolio group**
scope switcher beside its existing project-selection controls.

- **Selected projects** continues to use Bigboard's existing per-user
  `bigboard_selected` list.
- A Portfolio group is a temporary view scope. Switching to one never rewrites
  the saved Bigboard selection.
- Only active projects the current user can access are rendered, even if a
  Portfolio group contains additional projects.
- If PortfolioDashboard is absent or unavailable, the group switcher is hidden
  and the original Bigboard behavior is unchanged.

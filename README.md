# AdminBundle

AdminBundle provides helpers for building admin part in an SF2/SF3 app. It relies on several Composer packages
## Installation
## Configuration

## Features

### Widgets override and back-office presentation
Add lch_bootstrap_3_layout.html.twig as form theme, use form_row then.
Use base.admin.html.twig as root twig for every admin screen
Add base.admin.add.edit and base.admin.list with other inclusion (Media)

Use attribute width to define row width
force_two_columns_presentation to force classical 2 col presentation (in panel for example see SEO)
attr no_label to hide label (see SEO)

#### Override templates fragments
LchAdminBundle provide several templates fragments
- fragents/horizontalMenu.html.twig
This is the top menu. Provide with a simple exemple, you can easily override it by simply create `app/Resources/LchAdminBundle/views/fragments/horizontalMenu.html.twig`

### Lists
### Menu organization
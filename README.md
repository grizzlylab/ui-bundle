GrizzlylabUIBundle
==================

UI Twig helpers (alert, modal,...) for Twitter Bootstrap 3 and others.
Easy way to generate redundant HTML (HTML only, not JS or CSS).

###1. Requirements
- PHP >=5.4
- Twig 1.*
- Symfony ~2.7

###2. Installation

- ```composer require 'grizzlylab/ui-bundle@dev-master'```
- in AppKernel.php: ```new Grizzlylab\Bundle\UIBundle\GrizzlylabUIBundle()```
- optionnal : Install Boostrap 3 if you will use the default configuration

    ```
      <!-- include Bootstrap 3 CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <!-- include Boostrap 3 JS -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    ```

###2. Configuration

####Basic configuration (to use defaults)
```
#app/config/config.yml
grizzlylab_ui:
    alert: ~
```

####Complete default configuration
```
#app/config/config.yml
grizzlylab_ui:
    alert:
        translation_domain:   messages
        translation_parameters:  []
        translate:            true
        escape_message:       true
        escape_prefix:        false
        context:              info # One of "info"; "success"; "warning"; "danger"
        dismissible:          false
        dismissible_button:   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        display_prefix:       true
        template:             'GrizzlylabUIBundle::alert.html.twig'
        prefixes:
            info:                 '<span class="glyphicon glyphicon-info-sign"></span> '
            success:              '<span class="glyphicon glyphicon-ok"></span> '
            warning:              '<span class="glyphicon glyphicon-warning-sign"></span> '
            danger:               '<span class="glyphicon glyphicon-warning-sign"></span> '
```

###2. Use in Twig

#### "Alert" Helper:

Tip: Each option defined in grizzlylab_ui.alert (config.yml) can be overridden.

Exemples:

Function:
```
{{ alert('Your form is not valid', {'context': 'danger'} }) }}
{{ alert('Your form is not valid', {'context': 'danger', 'display_prefix': false} }) }}
{{ alert('Your form is not valid', {'context': 'danger', 'prefix': '<span class="glyphicon glyphicon-info-sign"></span> '} }) }}
#You can even override default attributes:
{{ alert('Your form is not valid', {'attr': {'id': 'my-id', class': 'my-class'} }) }}
```

Filter:
```
{{ 'your form is not valid'|alert }}
```

If you use Bootstrap 3 (default), compliant HTML for modal will be generated (http://getbootstrap.com/components/#alerts).

License
-------
This bundle is under the MIT license.
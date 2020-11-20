GrizzlylabUIBundle
==================

UI Twig helpers (alert, modal,...) for Twitter Bootstrap 3 and others.
Easy way to generate redundant HTML (HTML only, not JS or CSS).

### 1. Installation

- ```composer require 'grizzlylab/ui-bundle@dev-master'```
- in AppKernel.php: ```new Grizzlylab\Bundle\UIBundle\GrizzlylabUIBundle()```
- optionnal : Install Boostrap 3 if you will use the default configuration

    ```
      <!-- include Bootstrap 3 CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <!-- include Boostrap 3 JS -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    ```

### 2. Configuration

#### Basic configuration (to use defaults)
```
#app/config/config.yml
grizzlylab_ui:
    alert: ~ #enable "alert" helper
    modal: ~ #enable "modal" helper
    modal_trigger: ~ #enable "modal_trigger" helper
    truncate: ~ #enabled "trigger" helper (only available as a filter, not a function)
```

#### Complete default configuration
```
# Default configuration for "GrizzlylabUIBundle"
grizzlylab_ui:
    alert:
        template:             'GrizzlylabUIBundle::alert.html.twig'
        translation_domain:   messages
        translation_parameters:  
            %%strong_start%%: '<strong>'
            %%strong_end%%:   '</strong>'
        translate:            true
        escape_message:       true
        escape_prefix:        false
        dismissible:          false
        dismiss_button:       '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        display_prefix:       true
        context:              info # One of "info"; "success"; "warning"; "danger"
        prefixes:
            info:                 '<span class="glyphicon glyphicon-info-sign"></span> '
            success:              '<span class="glyphicon glyphicon-ok"></span> '
            warning:              '<span class="glyphicon glyphicon-warning-sign"></span> '
            danger:               '<span class="glyphicon glyphicon-warning-sign"></span> '
    modal:
        template:             'GrizzlylabUIBundle::modal.html.twig'
        backdrop:             'true' # One of "true"; "false"; "static"
        keyboard:             'true' # One of "true"; "false";
        id:                   modal
        fade:                 true
        size:                 medium # One of "small"; "medium"; "large"
        escape_title:         true
        escape_body:          true
        translate_title:      true
        translate_body:       true
        title_markup:         h1
        title_translation_domain:  messages
        title_translation_parameters:
            %%strong_start%%: '<strong>'
            %%strong_end%%:   '</strong>'
        body_translation_domain:  messages
        body_translation_parameters:  
            %%strong_start%%: '<strong>'
            %%strong_end%%:   '</strong>'
        dismiss_button:       '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        keep_default_footer_buttons: true
        footer_raw_prepend: ''
        footer_raw_append: ''
        footer_buttons:
            -   #there is a close button in the footer by default
                link:                false
                escape:              true
                translate:           true
                dismiss:             true
                context:             default
                label:               grizzlylab_ui.modal.close
    modal_trigger:
        template:             'GrizzlylabUIBundle::modal_trigger.html.twig'
        context:              info # One of "info"; "success"; "warning"; "danger"
        escape:               true
        translate:            true
        translation_domain:   messages
        translation_parameters:  
            %%strong_start%%: '<strong>'
            %%strong_end%%:   '</strong>'
        size:                 medium # One of "small"; "medium"; "large"
        is_link:              false
    truncate_to_tooltip: 
        template:             'GrizzlylabUIBundle::truncate.html.twig'
        length:               30
        preserve:             false
        separator:            '...'  
        tooltip_placement:    'top'  #use one of these: top, right, bottom, left  
```

### 3. Use (in Twig)

Tips:

* Almost each option defined in grizzlylab_ui (config.yml) can be overridden.
* For all available options, please check [UIComponentExtension.php](https://github.com/grizzlylab/ui-bundle/blob/master/Twig/UIComponentExtension.php) (functions "alert", "modalTrigger" and "modal")

#### a) "Alert" Helper:

Examples:

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

#### b) "Modal" and "Modal Trigger" helpers:
Examples:

Function:
```
#trigger
{{ modal_trigger('my trigger label') }}
#modal
{{ modal('my modal body', {'title': my modal title'}) }}
```

Filter:
```
#trigger
{{ 'my trigger label'|modal_trigger }}
#modal
{{ 'my modal body'|modal({'title': my modal title'}) }}
```

#### c) "truncate_to_tooltip" filter
This filter depends on the "truncate" filter from the Twig "Text" extension (http://twig.sensiolabs.org/doc/extensions/text.html)
For performance reasons, you must enable Bootstrap tooltips (http://getbootstrap.com/javascript/#tooltips)
Then, you can simply use the filter like this: 
```
#will truncate the text and show the entire text in a tooltip (when mouse is over the truncated text)
{{ 'my very long text'|truncate_to_tooltip }}
{{ 'my very long text'|truncate_to_tooltip(length, options) }}
```

If you use Bootstrap 3 (default), compliant HTML will be generated ([alert](http://getbootstrap.com/components/#alerts),[modal](http://getbootstrap.com/javascript/#modals)).

License
-------
This bundle is under the MIT license.

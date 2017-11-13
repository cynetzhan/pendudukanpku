# Writing Your Own Documentation

Bonfire makes including documentation with your application, or even just one of your custom modules, as simple as including some text files.

## Docs Locations

To create application-specific documentation that can easily be versioned and shipped out with your application, simply place [CommonMark](http://commonmark.org/)-formatted text files in the `application/docs` folder.

For any modules that you create and want to create documentation for, just place the same CommonMark-formatted docs in the module's folder, under a new folder named `docs`.

    my_module/
        css/
        docs/
        . . .

The files must have the file extension of `.md` in order to be recognized by the system.
When a help page is displayed, the Table of Contents in the sidebar will automatically find your docs and display them in the order found.

## Custom Table of Contents

If you need more organization to your docs, you can specify a custom TOC to be used.
This allows for specifying custom names for the files, as well as splitting doc files into logical groups that you specify, but only one level deep.

To use a custom TOC, create a file called `_toc.ini` within your docs folder.
If this file is present, it will be used to display the links, instead of auto-generating the links from the existing files.
This file is a standard PHP .ini file.
The "options" within the file are the filename and the display name.
The filename is listed on the left of the '=' with the text used to display the link listed on the right.

<pre>
my_page = My Great New Documentation Package
</pre>

To group the files and provide a header, you would use the .ini's section syntax.

<pre>
[Section 1]
my_page = My New Documentation Package
</pre>

The filename must include in it's "path" the area the documentation came from, either 'application', 'bonfire', or your module's folder name.

<pre>
application/my_page = My New Documentation Package
my_module/my_page   = My New Module Docs
</pre>

## Configuring Documentation

The docs system allows you to do some simple customization that allows you to integrate it into the needs of your application easily.
The system uses 2 groups 'application' and 'developer' to separate your application specific documentation from Bonfire's core documentation.

All documentation config settings can be found in the module's config file at `bonfire/modules/docs/config/docs.php`.

### Theme

To specify a theme to be used only for the documentation, set the `docs.theme` setting.
This allows you to completely customize the how the information looks and is displayed to match your branding, ad needs, etc.

    $config['docs.theme'] = 'docs';

### Landing Page

You can customize the group that is shown if someone simply browses to `/docs`.

    $config['docs.default_group'] = 'developer';

### Which Groups Show?

You can configure whether application or developer documentation is displayed.

    $config['docs.show_dev_docs'] = true;
    $config['docs.show_app_docs'] = true;

### Environment-based Display of docs

You can configure docs to be displayed based on the current environment by configuring the `docs.permitted_environments` variable.
If the current environment is not listed in the array, any user attempting to navigate to the docs module will be redirected to the site's base URL and an error message will be displayed.

    $config['docs.permitted_environments'] = array('development', 'testing', 'production');

### Override Application-configured CommonMark Driver

The docs module will use the application-configured CommonMark driver to parse the docs.
This value is normally set in `/application/config/application.php`.

If you use the CommonMark library elsewhere in your application, it will often make sense to configure one driver for your application and another for the docs module.
This can be done by setting `docs.commonmark_driver` in `/docs/config/docs.php` to the name of the desired driver.

    $config['docs.commonmark_driver'] = 'MarkdownExtra';

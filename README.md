# WordPress Plugin: Post UUID

| Header             | Value |
| ------------------ | ----- |
| Requires PHP:      | 7.2.0 |
| Requires at least: | 4.7.0 |
| Tested up to:      | 6.0.2 |
| License:           | MIT   |

Use a [UUID][wikipedia/uuid] (Universally Unique Identifier) instead of
a plain permalink as a Post GUID (Global Unique Identifier) in WordPress.

This plugin is useful for modern WordPress projects to avoid having to replace
or deduplicate the site URL when migrating content across deployment environments.

## Overview

By default, this plugin will generate a version 4 UUID using the WordPress function
[`wp_generate_uuid4()`][wp_generate_uuid4] (introduced in WordPress 4.7.0).

This plugin can be customized via two filters:

* 
  ```php
  apply_filters( 'jazz/post_uuid/generator/pre_discovery', Closure|null $pre_generator = null ) : Closure|null
  ```
  Allows the finder to be short-circuited, by returning a UUID generator.
* 
  ```php
  apply_filters( 'jazz/post_uuid/generator/discovery', Closure $generator ) : Closure
  ```
  Filters the UUID generator discovered by the finder.

## Background

WordPress traditionally uses a post's [plain permalink][wordpress.org?p=10867570]
as a GUID.

> When a feed reader is reading feeds, it uses the contents of the GUID field to
> know whether or not it has displayed a particular item before. It does this in
> one of various ways, but the most common method is simply to store a list of
> GUID’s that it has already displayed and “marked as read” or similar.
>
> Thus, changing the GUID will mean that many feed readers will suddenly display
> your content in the user’s reader again as if it was new content, possibly
> annoying your users.
>
> In order for the GUID field to be “globally” unique, it is an accepted
> convention that the URL or some representation of the URL is used.
> Thus, if you own `example.com`, then you’re the only one using `example.com`
> and thus it’s unique to you and your site. […]
>
> However, […] the GUID must never change. Even if you shift domains around,
> the post is still the same post, even in a new location. Feed readers being
> shifted to your new feeds when you change URLs should still know that they’ve
> read some of your posts before, and thus the GUID must remain unchanged.
>
> — "[Changing The Site URL: Important GUID Note][wordpress.org?p=10840035]",
> WordPress Support

This works well enough when a site is hosted at only one location.
Even if the site moves to a new domain.

When a site is hosted at multiple locations (deployment environments)
for development, staging, and production, content migration without careful
attention can accidentally expose a non-production URL which can also complicate
the deduplication of an identifier that is meant to be immutable.

By using a unique identifier that does not reference the site URL, such as UUID,
the GUID can be truly unique and persistent regardless of the site's URL.

## Alternatives

* Plugins such as [WP Migrate DB][deliciousbrains/wp-migrate-db],
  provide the option to replace GUIDs.
* WP-CLI provides a [`search-replace`][wp-cli-search-replace] command
  that can be used to replace GUIDs.

## Installation

Require this package, with [Composer](https://getcomposer.org/),
from the root directory of your project.

```sh
composer require wp-jazz/wp-post-uuid
```

If your project uses [composer/installers], the package should install
as a must-use plugin.

If the package is installed as a regular plugin, activate the package via
WP-CLI or the WordPress administrator dashboard.

If the package is installed into Composer's vendor directory, activate the
package via a must-use plugin file or from a file that has access to the
WordPress hooks system.

## Acknowledgments

Prior Art:

* [geekysoft/urn-uuid] by Geeky Software.
* [rmccue/realguids] by Ryan McCue.
* [wordplate/uuid] by Vincent Klaiber, Chris Andersson.

## Further reading

* "[Proper RFC 4122 UUIDs as GUIDs in WordPress][bjornjohansen.com?p=1901]". Bjørn Johansen.
  Published 2017-06-10. Accessed 2022-08-29.
* "[Understanding WordPress GUIDs: What They Are, and Why Change Them][deliciousbrains.com?p=6944]". Brad Touesnard, Delicious Brains.
  Published 2021-11-17. Accessed 2022-08-29.
* "[Changing The Site URL: Important GUID Note][wordpress.org?p=10840035]". WordPress Support.
  Revised 2022-04-02. Accessed 2022-08-29.
* "[Using Permalinks: Plain Permalinks][wordpress.org?p=10867570]". WordPress Support.
  Revised 2022-02-19. Accessed 2022-08-29.

[bjornjohansen.com?p=1901]:      https://bjornjohansen.com/uuid-as-wordpress-guid
[composer/installers]:           https://github.com/composer/installers
[deliciousbrains.com?p=6944]:    https://deliciousbrains.com/wordpress-post-guids-sometimes-update/
[geekysoft/urn-uuid]:            https://wordpress.org/plugins/urn-uuid/
[RFC 4122]:                      https://www.rfc-editor.org/rfc/rfc4122
[ramsey/uuid]:                   https://github.com/ramsey/uuid
[rmccue/realguids]:              https://github.com/rmccue/realguids
[wikipedia/uuid]:                https://en.wikipedia.org/wiki/Universally_unique_identifier
[wp-cli-search-replace]:         https://developer.wordpress.org/cli/commands/search-replace/
[wp_generate_uuid4]:             https://developer.wordpress.org/reference/functions/wp_generate_uuid4/
[wordplate/uuid]:                https://packagist.org/packages/wordplate/uuid
[wordpress.org?p=10840035]:      https://wordpress.org/support/article/changing-the-site-url/#important-guid-note
[wordpress.org?p=10867570]:      https://wordpress.org/support/article/using-permalinks/#plain-permalinks
[deliciousbrains/wp-migrate-db]: https://wordpress.org/plugins/wp-migrate-db/

# WordPress Plugin: Post UUID

Use a [UUID][wikipedia/uuid] (Universally Unique Identifier), or an alternative,
instead of a plain permalink as a Post GUID (Global Unique Identifier) in WordPress.

This plugin is useful for modern WordPress projects to avoid having to replace
or deduplicate the site URL when migrating content across deployment environments.

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
[deliciousbrains.com?p=6944]:    https://deliciousbrains.com/wordpress-post-guids-sometimes-update/
[RFC 4122]:                      https://www.rfc-editor.org/rfc/rfc4122
[wikipedia/uuid]:                https://en.wikipedia.org/wiki/Universally_unique_identifier
[wordpress.org?p=10840035]:      https://wordpress.org/support/article/changing-the-site-url/#important-guid-note
[wordpress.org?p=10867570]:      https://wordpress.org/support/article/using-permalinks/#plain-permalinks
[deliciousbrains/wp-migrate-db]: https://wordpress.org/plugins/wp-migrate-db/

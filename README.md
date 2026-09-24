# Just Share

[繁體中文說明請參見 README.zh-TW.md](README.zh-TW.md)

Share buttons and related posts for WordPress that ad blockers leave alone.

## Why

Share plugins usually load a script from a third-party domain, which ad blockers block. Filter lists such as Fanboy's Social also hide links by address, for example `a[href^="https://www.facebook.com/sharer.php"]`. Visitors with an ad blocker see no buttons.

Just Share renders each button on the server as a plain link back to your own site (`/?jsp_go=facebook&jsp_id=123`), and your site redirects to the network. There are no third-party requests, the class names avoid words generic cosmetic filters match, and the link buttons need no JavaScript.

Version 0.1.0 was checked against all 40,929 generic cosmetic selectors and 62,166 network rules in EasyList, Fanboy's Social and Fanboy's Annoyance (September 2026). None matched the buttons, the related posts or the plugin's files.

## Features

* Facebook, X, Threads, LINE, Plurk, Telegram and email.
* Copy link, plus a "More options" button for the system share sheet where `navigator.share` exists.
* Before the content, after it, or both, with optional text above the buttons.
* Related posts: the posts published just before the current one in the same categories, with newer posts filling in when needed.
* Settings page, and the `just_share_settings` option in the REST API settings endpoint.
* No tracking, no share counts, no external requests.

## Requirements

* WordPress 6.4 or higher
* PHP 7.4 or higher

## Filters

| Filter | Purpose |
|---|---|
| `just_share_networks` | Add or change networks. A `link` entry with a `url` template using `{url}` and `{title}` goes through the redirect. |
| `just_share_post_url` | Change the shared URL, for example to add campaign parameters. |
| `just_share_related_ids` | Replace the related post IDs. |

## Open Graph

Just Share does not print Open Graph tags. Share previews come from your SEO plugin, so make sure it prints `og:title` and `og:image` on single posts.

## Credits

Brand icons from [Simple Icons](https://simpleicons.org) (CC0 1.0). Email, link and share icons from Material Icons (Apache License 2.0).

## License

GPL-2.0-or-later

=== Just Share ===
Contributors: ivanusto
Tags: share buttons, social sharing, related posts, privacy, ad blocker
Requires at least: 6.4
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Share buttons and related posts that ad blockers leave alone. Plain server-rendered links, inline SVG icons, no third-party requests.

== Description ==

Most share button plugins load a script from a third-party domain. Ad blockers block that script, and cosmetic filters also hide any link whose address starts with a known share URL, such as `https://www.facebook.com/sharer.php`. Visitors with an ad blocker see no buttons at all.

Just Share renders every button on the server as a normal link that points back to your own site, for example `/?jsp_go=facebook&jsp_id=123`. Your site answers with a redirect to the network's share page. Nothing loads from another domain, the class names avoid words that generic filters match, and the buttons work without JavaScript.

* Facebook, X, Threads, LINE, Plurk, Telegram and email.
* Copy link, and a "More options" button that opens the system share sheet on phones.
* Before the content, after it, or both, with optional text above the buttons.
* Related posts under the content: the posts published just before this one in the same categories, with thumbnails. Every post links to a different nearby set, so older posts stay reachable.
* Settings under Settings > Just Share, also available as `just_share_settings` in the REST API settings endpoint.
* No tracking, no counts, no external requests.

The redirect only goes to a built-in network template filled with a published post's permalink and title, so it cannot be used as an open redirect. It sends `X-Robots-Tag: noindex, nofollow` and no-cache headers.

= Filters =

* `just_share_networks` adds or changes networks. An entry with `type` set to `link` and a `url` template containing `{url}` and `{title}` is reached through the redirect.
* `just_share_post_url` changes the URL that is shared, for example to add campaign parameters.
* `just_share_related_ids` replaces the related post IDs.

= Credits =

Brand icons from Simple Icons (CC0 1.0). Email, link and share icons from Material Icons (Apache License 2.0).

== Installation ==

1. Upload the plugin zip under Plugins > Add New > Upload Plugin and activate it.
2. Go to Settings > Just Share to pick buttons, position and related posts.

== Frequently Asked Questions ==

= Does it add Open Graph tags? =

No. Share previews come from your SEO plugin's Open Graph tags. Check that one is outputting `og:title` and `og:image` on single posts.

= Will full-page caching break the redirect? =

No. The redirect URL carries a query string and is sent with no-cache headers, which page caches skip by default.

== Changelog ==

= 0.1.0 =
* First release.

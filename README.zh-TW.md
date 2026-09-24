# Just Share

不會被擋廣告套件藏起來的 WordPress 分享按鈕與延伸閱讀。

## 為什麼需要

一般的分享外掛會從第三方網域載入指令碼，而擋廣告套件會擋掉它。Fanboy's Social 等清單還會依網址藏起連結，例如 `a[href^="https://www.facebook.com/sharer.php"]`。所以有裝擋廣告套件的訪客，完全看不到分享按鈕。

Just Share 的每個按鈕都由伺服器輸出，是連回本站的一般連結（`/?jsp_go=facebook&jsp_id=123`），再由本站轉址到各平台。它不向第三方發出請求，class 名稱避開通用過濾規則會比對的字，連結按鈕也不需要 JavaScript。

0.1.0 版已對照 EasyList、Fanboy's Social 與 Fanboy's Annoyance（2026 年 9 月版）的全部 40,929 條通用外觀規則與 62,166 條網路規則，沒有任何一條命中按鈕、延伸閱讀或外掛檔案。

## 功能

* Facebook、X、Threads、LINE、噗浪、Telegram 與電子郵件。
* 複製連結，以及「更多選項」按鈕。後者會開啟系統的分享選單，只在支援 `navigator.share` 的裝置上出現。
* 可放在內文之前、之後或前後都放，按鈕上方可加一行文字。
* 延伸閱讀：同分類中，在本篇之前發表的文章；數量不夠時以較新的文章補足。
* 提供設定頁，也可以透過 REST API 的設定端點修改 `just_share_settings`。
* 不追蹤、不計數、不向外發出請求。

## 需求

* WordPress 6.4 以上
* PHP 7.4 以上

## Open Graph

Just Share 不輸出 Open Graph 標籤，分享預覽來自 SEO 外掛。請確認單篇文章有輸出 `og:title` 與 `og:image`。

## 授權

GPL-2.0-or-later。品牌圖示來自 [Simple Icons](https://simpleicons.org)（CC0 1.0），電子郵件、連結與分享圖示來自 Material Icons（Apache License 2.0）。

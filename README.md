## サービス概要
私はお酒を飲むことが好きなのですが、美味しいお酒を飲んだとしても後日に
「あのお酒はなんていう名前だったっけな」や「あれはどこで飲んだっけ？」と中々思い出せず
もう一度飲むことが出来なくなってしまうことが多々ありました。  
本webアプリはそれを防ぎたいという思いから開発した、お酒の詳細や画像を投稿しリスト化できる管理アプリです。  
  
https://alc-app.matsu.works/
  
テストアカウントでお試しの場合はこちら  
【メールアドレス】test@test.com  
【パスワード】password
  
実装した機能や開発の際の技術は下記の通りです。  
## 機能一覧
* ユーザー情報の登録 / ログイン機能
* Googleアカウントでのユーザー登録 / ログイン機能
* リストのCRUD機能
* リストの検索機能
* 画像のアップロード / 削除機能
* 画像一覧からリスト情報の取得・表示(リレーション)
* ページネーション機能
* 作成 / 編集画面でのバリデーション機能
* レスポンシブ対応
## 使用技術
### 使用言語 / フレームワーク / パッケージ
* PHP:8.2.9  
* Laravel:10.39.0  
* Laravel Breeze:1.27  
* Laravel Sanctum:3.3  
* Laravel Socialite:5.11  
* CSS: Tailwind CSS、SCSS
### RDBMS
* MySQL:8.0.34
### その他
* OAuth
### 環境構築
* Docker / Docker Compose
### 本番環境
レンタルサーバーへのデプロイ（Xサーバー） 
### PCスペック
* MacBook Pro
* Sonoma 14.1.2
* Apple M1 Pro
* メモリ: 16GB
## ER図  
![ER図](https://alc-app.matsu.works/storage/er.jpg)
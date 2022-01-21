## 🏰  Sindbad
現在制作中のモバイルアプリのAPIをLaravelで実装しています。  
旅行プランを作成、閲覧できるアプリです。  
友達の書いている記事です。  
https://note.com/design_frk/n/n02542eda1da9

## 📚 API Docs
APIの仕様書です  
https://app.swaggerhub.com/apis-docs/tooooofu24/sindbad/0

## 🖥 WEB 
WEBで実装したものたちです。
- [スポットアップロード](https://sindbad-travel.com/spots/create)
- [スポット一覧（画像の更新）](https://sindbad-travel.com/spots/)
- [プランの表示（WEB版）](https://sindbad-travel.com/plans/3)
- [スポットの承認](https://sindbad-travel.com/spots/check)

## 👨‍💻 Dependencies
>**言語・FW・ライブラリ等**
- PHP 7.3.11
- Laravel 8.70.2
- Bootstrap
- Python 3.9.0 (スポット登録時にスクレイピングで使用)
- [League/Csv](https://csv.thephpleague.com/)（CSVのアップロードなどで使うパッケージ）
>**API**
- [gooラボ API](https://labs.goo.ne.jp/api/)（ひらがな化API、形態素解析APIを使用）  
>**インフラ（本番）**  
- [さくらのVPS](https://vps.sakura.ad.jp/)（CentOS 7系でApacheとMySQLを使用）
- AWS S3
>**インフラ（ローカル）**
- PHPのビルトインサーバ 
- MAMP

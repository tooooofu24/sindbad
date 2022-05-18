## Download Links
- [iOS](https://apps.apple.com/jp/app/sindbad-%E5%85%B1%E6%9C%89%E3%81%A7%E3%81%8D%E3%82%8B%E6%97%85%E8%A1%8C%E8%A8%88%E7%94%BB%E3%82%A2%E3%83%97%E3%83%AA/id1618208505)
- [Android](https://play.google.com/store/apps/details?id=com.sindbad_travel.sindbad)

## 🏰  Sindbad
現在制作中のモバイルアプリのAPIをLaravelで実装しています。  
旅行プランを作成、閲覧できるアプリで、現在リリースの準備をしています。  
キャッチコピーは「旅行限定のインスタグラム」です！  
友達の書いている記事です。  
https://note.com/design_frk/n/n02542eda1da9

## 💡 Content
できることは主に2つです。  
- 旅行プランの作成
- 他の人の作った旅行プランの閲覧

## 📚 API Docs
APIの仕様書です  
https://app.swaggerhub.com/apis-docs/tooooofu24/sindbad/1.0

## 🖥 Web Pages
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
- Vue.js 3.0.5
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
(Dockerは今後挑戦します...笑)

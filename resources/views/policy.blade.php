@extends('layouts.app')

@section('title','シンドバッド - 利用規約')
@section('nav-title','利用規約')

@section('content')
@include('layouts.public-nav')
<main class="px-4 col-12 col-md-11 col-lg-10 col-xl-9 col-xxl-8 mx-auto">
    <h2 class="text-center">プライバシーポリシー</h2>
    <p>
        sindbad運営チーム(以下「当方」といいます。)は、当方の提供するサービス(以下「本サービス」といいます。)における、ユーザーについての個人情報を含む利用者情報の取扱いについて、以下のとおりプライバシーポリシー(以下「本ポリシー」といいます。)を定めます。
    </p>
    <h3>収集する利用者情報及び収集方法</h3>
    <p>
        本ポリシーにおいて、「利用者情報」とは、ユーザーの識別に係る情報、通信サービス上の行動履歴、その他ユーザーまたはユーザーの端末に関連して生成または蓄積された情報であって、本ポリシーに基づき当方が収集するものを意味するものとします。本サービスにおいて当方が収集する利用者情報は、その収集方法に応じて、以下のようなものとなります。
    </p>
    <ol>
        <li>
            ユーザーからご提供いただく情報<br>
            本サービスを利用するために、または本サービスの利用を通じてユーザーからご提供いただく情報は以下のとおりです。
        </li>
        <ul>
            <li>
                ユーザー名等プロフィールに関する情報
            </li>
            <li>
                メールアドレス等連絡先に関する情報
            </li>
            <li>
                入力フォームその他当方が定める方法を通じてユーザーが入力または送信する情報
            </li>
        </ul>
        <li>
            ユーザーが本サービスの利用において、他のサービスと連携を許可することにより、当該他のサービスからご提供いただく情報<br>
            ユーザーが、本サービスを利用するにあたり、ソーシャルネットワーキングサービス等の他のサービスとの連携を許可した場合には、その許可の際にご同意いただいた内容に基づき、以下の情報を当該外部サービスから収集します。
        </li>
        <ul>
            <li>
                当該外部サービスでユーザーが利用するID
            </li>
            <li>
                その他当該外部サービスのプライバシー設定によりユーザーが連携先に開示を認めた情報
            </li>
        </ul>
        <li>
            ユーザーが本サービスを利用するにあたって、当方が収集する情報当方は、本サービスへのアクセス状況やそのご利用方法に関する情報を収集することがあります。これには以下の情報が含まれます。
        </li>
        <ul>
            <li>
                利用端末情報
            </li>
            <li>
                IPアドレス
            </li>
            <li>
                広告識別子(IDFA または Google Advertising ID 等)
            </li>
            <li>
                クッキー情報
            </li>
            <li>
                ユーザーエージェント
            </li>
        </ul>
    </ol>
    <h3>利用目的</h3>
    <p>
        本サービスのサービス提供にかかわる利用者情報の具体的な利用目的は以下のとおりです。
    </p>
    <ol>
        <li>
            本サービスに関する登録の受付、本人確認、ユーザー認証、ユーザー設定の記録のため
        </li>
        <li>
            ユーザーのトラフィック測定及び行動測定のため
        </li>
        <li>
            広告の配信、表示及び効果測定のため
        </li>
        <li>
            本サービスに関するご案内、お問い合わせ等への対応のため
        </li>
        <li>
            本サービスに関する当方の規約、ポリシー等(以下「規約等」といいます。)に違反する行為に対する対応のため
        </li>
        <li>
            本サービスに関する規約等の変更などを通知するため
        </li>
    </ol>
    <h3>通知・公表または同意取得の方法、利用中止要請の方法</h3>
    <ol>
        <li>
            ユーザーは、本サービスの所定の設定を行うことにより、利用者情報の全部または一部についてその収集又は利用の停止を求めることができ、この場合、当方は速やかに、当方の定めるところに従い、その利用を停止します。なお利用者情報の項目によっては、その収集または利用が本サービスの前提となるため、当方所定の方法により本サービスを退会した場合に限り、当方はその収集又は利用を停止します。
        </li>
    </ol>
    <h3>第三者提供</h3>
    <p>
        当方は、利用者情報のうち、個人情報については、あらかじめユーザーの同意を得ないで、第三者(日本国外にある者を含みます。)に提供しません。但し、次に掲げる必要があり第三者(日本国外にある者を含みます。)に提供する場合はこの限りではありません。
    </p>
    <ol>
        <li>
            当方が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合
        </li>
        <li>
            合併その他の事由による事業の承継に伴って個人情報が提供される場合
        </li>
        <li>
            第4項の定めに従って、提携先または情報収集モジュール提供者へ個人情報が提供される場合
        </li>
        <li>
            国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、ユーザーの同意を得ることによって当該事務の遂行に支障を及ぼすおそれがある場合
        </li>
        <li>
            その他、個人情報の保護に関する法律(以下「個人情報保護法」といいます。)その他の法令で認められる場合
        </li>
    </ol>
    <h3>個人情報の開示</h3>
    <p>
        当方は、ユーザーから、個人情報保護法の定めに基づき個人情報の開示を求められたときは、ユーザーご本人からのご請求であることを確認の上で、ユーザーに対し、遅滞なく開示を行います(当該個人情報が存在しないときにはその旨を通知いたします。)。但し、個人情報保護法その他の法令により、当方が開示の義務を負わない場合は、この限りではありません。なお、個人情報の開示につきましては、手数料(1件あたり1,000円)を頂戴しておりますので、あらかじめ御了承ください。
    </p>
    <h3>個人情報の訂正及び利用停止等</h3>
    <ol>
        <li>
            当方は、ユーザーから、(1)個人情報が真実でないという理由によって個人情報保護法の定めに基づきその内容の訂正を求められた場合、及び(2)あらかじめ公表された利用目的の範囲を超えて取扱われているという理由または偽りその他不正の手段により収集されたものであるという理由により、個人情報保護法の定めに基づきその利用の停止を求められた場合には、ユーザーご本人からのご請求であることを確認の上で遅滞なく必要な調査を行い、その結果に基づき、個人情報の内容の訂正または利用停止を行い、その旨をユーザーに通知します。なお、訂正または利用停止を行わない旨の決定をしたときは、ユーザーに対しその旨を通知いたします。
        </li>
        <li>
            当方は、ユーザーから、ユーザーの個人情報について消去を求められた場合、当方が当該請求に応じる必要があると判断した場合は、ユーザーご本人からのご請求であることを確認の上で、個人情報の消去を行い、その旨をユーザーに通知します。
        </li>
        <li>
            個人情報保護法その他の法令により、当方が訂正等または利用停止等の義務を負わない場合は、8-1および8-2の規定は適用されません。
        </li>
    </ol>
    <h3>お問い合わせ窓口</h3>
    <p>
        ご意見、ご質問、苦情のお申出その他利用者情報の取扱いに関するお問い合わせは、下記の窓口までお願いいたします。
    </p>
    <ol>
        <p>
            sindbad運営チーム<br>連絡先:info@sindbad-travel.com
        </p>
    </ol>

    <h3>プライバシーポリシーの変更手続</h3>
    <p>
        当方は、必要に応じて、本ポリシーを変更します。但し、法令上ユーザーの同意が必要となるような本 ポリシーの変更を行う場合、変更後の本ポリシーは、当方所定の方法で変更に同意したユーザーに対してのみ適用されるものとします。なお、当方は、本ポリシーを変更する場合には、変更後の本ポリシーの施行時期及び内容を当方のウェブサイト上での表示その他の適切な方法により周知し、またはユーザーに通知します。
    </p>
    <p class="text-end">
        【2022年2月24日制定】
    </p>

</main>
@endsection
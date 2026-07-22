<?php
/**
 * Template Part: International Safaris For International Travelers
 * File:   template-parts/home/international.php
 *
 * Rebuilt per request: this section no longer lists African
 * destination countries (that content lives in Top Destinations).
 * It now shows 6 visitor/source-country cards — flag, language code,
 * and a welcome message translated into that country's language —
 * matching the section's actual purpose: "International Safaris
 * Designed for International Travelers".
 *
 * @package PrideOfAfrica
 */

$signoff = 'Karibu Kenya. Karibu East Africa!';

$cards = [
    [
        'flag'    => '🇺🇸',
        'lang'    => 'EN',
        'country' => 'United States',
        'welcome' => [
            'Welcome, travelers from the United States!',
            "Discover the magic of Kenya and East Africa—where breathtaking wildlife, stunning landscapes, rich cultures, and unforgettable adventures await. We look forward to welcoming you for the safari experience of a lifetime.",
        ],
        'cta'     => 'Explore Safaris',
    ],
    [
        'flag'    => '🇩🇪',
        'lang'    => 'DE',
        'country' => 'Deutschland',
        'welcome' => [
            'Willkommen, Reisende aus Deutschland!',
            'Entdecken Sie die Magie Kenias und Ostafrikas – wo atemberaubende Tierwelt, wunderschöne Landschaften, reiche Kulturen und unvergessliche Abenteuer auf Sie warten. Wir freuen uns darauf, Sie zum Safari-Erlebnis Ihres Lebens begrüßen zu dürfen.',
        ],
        'cta'     => 'Safaris entdecken',
    ],
    [
        'flag'    => '🇷🇺',
        'lang'    => 'RU',
        'country' => 'Россия',
        'welcome' => [
            'Добро пожаловать, путешественники из России!',
            'Откройте для себя магию Кении и Восточной Африки — здесь вас ждут захватывающая дикая природа, потрясающие пейзажи, богатая культура и незабываемые приключения. Мы с нетерпением ждём возможности приветствовать вас в сафари-путешествии всей вашей жизни.',
        ],
        'cta'     => 'Смотреть сафари',
    ],
    [
        'flag'    => '🇺🇦',
        'lang'    => 'UK',
        'country' => 'Україна',
        'welcome' => [
            'Ласкаво просимо, мандрівники з України!',
            'Відкрийте для себе магію Кенії та Східної Африки — тут на вас чекають захоплива дика природа, приголомшливі краєвиди, багата культура та незабутні пригоди. Ми з нетерпінням чекаємо нагоди привітати вас у сафарі-подорожі вашого життя.',
        ],
        'cta'     => 'Переглянути сафарі',
    ],
    [
        'flag'    => '🇨🇳',
        'lang'    => 'ZH',
        'country' => '中国',
        'welcome' => [
            '欢迎来自中国的旅行者！',
            '探索肯尼亚和东非的独特魅力——令人惊叹的野生动物、壮丽的风景、丰富的文化以及难忘的冒险正等待着您。我们期待欢迎您开启一生难忘的野生动物园之旅。',
        ],
        'cta'     => '立即探索',
    ],
    [
        'flag'    => '🇫🇷',
        'lang'    => 'FR',
        'country' => 'France',
        'welcome' => [
            'Bienvenue aux voyageurs venant de France !',
            "Découvrez la magie du Kenya et de l'Afrique de l'Est, où une faune à couper le souffle, des paysages magnifiques, des cultures riches et des aventures inoubliables vous attendent. Nous avons hâte de vous accueillir pour le safari d'une vie.",
        ],
        'cta'     => 'Découvrir les safaris',
    ],
];

$contact_url = home_url( '/contact/' );
?>
<section class="c-international l-section" id="international-destinations" aria-labelledby="international-heading">
    <div class="u-container">
        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Global Reach', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="international-heading"><?php esc_html_e( 'International Safaris Designed for International Travelers', 'pride-of-africa' ); ?></h2>
            <p class="c-section-header__desc"><?php esc_html_e( 'Wherever you\'re travelling from, we\'ll help you plan your safari in your own language.', 'pride-of-africa' ); ?></p>
        </div>

        <div class="c-international__grid" role="list">
            <?php foreach ( $cards as $card ) : ?>
            <a class="c-international__card" href="<?php echo esc_url( $contact_url ); ?>" role="listitem"
               aria-label="<?php echo esc_attr( sprintf( '%1$s — %2$s', $card['country'], $card['welcome'][0] ) ); ?>"
               lang="<?php echo esc_attr( strtolower( $card['lang'] ) ); ?>">
                <span class="c-international__flag" aria-hidden="true"><?php echo esc_html( $card['flag'] ); ?></span>
                <span class="c-international__lang-badge"><?php echo esc_html( $card['lang'] ); ?></span>
                <h3 class="c-international__name"><?php echo esc_html( $card['country'] ); ?></h3>
                <p class="c-international__welcome-greeting"><?php echo esc_html( $card['welcome'][0] ); ?></p>
                <p class="c-international__welcome-body"><?php echo esc_html( $card['welcome'][1] ); ?></p>
                <p class="c-international__signoff" lang="sw"><?php echo esc_html( $signoff ); ?></p>
                <span class="c-international__cta">
                    <?php echo esc_html( $card['cta'] ); ?>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

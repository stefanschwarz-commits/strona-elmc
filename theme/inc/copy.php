<?php
/**
 * All page copy in Polish and English, plus the data behind the repeated blocks.
 *
 * Source: the Claude Design handoff "ELMC 2027 Strona.dc.html" and its text export
 * (exports/ELMC-2027-teksty-PL-EN.md, 19.09.2026). Polish is the original; the English
 * version is a working translation that still needs a native review.
 *
 * Texts added here that are NOT in the design (marked "runtime"): form status messages,
 * consent clauses and e-mail bodies - the design has no states for a server-side form.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function elmc2027_copy( $lang = null ) {
	$lang = ( 'en' === $lang || 'pl' === $lang ) ? $lang : elmc2027_lang();

	$pl = array(
		'navMission'   => 'Misja',
		'navAbout'     => 'O kongresie',
		'navRecap'     => 'Relacja 2026',
		'navSpeakers'  => 'Prelegenci',
		'navPartners'  => 'Partnerstwo',
		'notify'       => 'Powiadom mnie',
		'skipToMain'   => 'Przejdź do treści',

		'heroKicker'   => 'Kolejna edycja — w przygotowaniu',
		'heroTitle'    => 'Europejski Kongres Mobilności Pracy',
		'heroLead'     => 'Od 2013 roku ELMC łączy europejskie instytucje mobilności pracy, agencje zatrudnienia i decydentów. Edycja 2027 jest w przygotowaniu — zostaw e-mail, a powiadomimy Cię, gdy ogłosimy daty i otworzymy rejestrację.',
		'heroAlt'      => 'Mural: European Labour Mobility Congress, z przekreślonym słowem „Labour” i dopisanym „Service”, oraz hasłem „Barriers down! Europe forward!”',
		'emailPh'      => 'Twój adres e-mail',
		'noSpam'       => 'Jedna wiadomość, bez spamu. Wypisz się w każdej chwili.',

		'fEdition'     => 'Edycja',
		'fEditionV'    => 'X — dziesiąta',
		'fDates'       => 'Daty',
		'fPlace'       => 'Miejsce',
		'fOrg'         => 'Organizator',
		'tba'          => 'do ogłoszenia',
		'elmi'         => 'Europejski Instytut Mobilności Pracy',

		'bandBody'     => 'Mniej barier dla usług i pracowników na jednolitym rynku, więcej Europy w praktyce. Rozmawiamy o delegowaniu, koordynacji zabezpieczenia społecznego i przyszłości swobody świadczenia usług.',

		'missionKicker' => 'Misja',
		'missionLead'  => 'Budujemy europejskie forum, na którym administracja, biznes, nauka i partnerzy społeczni rozmawiają o mobilności pracy bez uprzedzeń — na faktach, w jednym miejscu, raz w roku.',
		'missionBody'  => 'Swoboda świadczenia usług i przepływu pracowników to fundament jednolitego rynku, a zarazem jedno z najbardziej spornych pól europejskiej polityki. ELMC powstał, by ten spór ucywilizować: dać głos praktykom, skonfrontować regulacje z rzeczywistością firm i pracowników oraz wypracować rozwiązania, które służą całej Unii.',
		'pillars'      => array(
			array( 'title' => 'Dialog ponad podziałami', 'desc' => 'Przy jednym stole: kraje wysyłające i przyjmujące, pracodawcy i związki, urzędnicy i przedsiębiorcy.' ),
			array( 'title' => 'Fakty zamiast mitów', 'desc' => 'Dane, badania i doświadczenia z rynku jako podstawa rozmowy o delegowaniu i mobilności.' ),
			array( 'title' => 'Wpływ na regulacje', 'desc' => 'Wnioski z Kongresu trafiają do Komisji, Parlamentu Europejskiego i rządów krajowych.' ),
		),

		'themeKicker'  => 'Temat edycji 2027',
		'themeSlogan'  => 'Nie ma konkurencyjności bez mobilności.',
		'themeBody'    => 'W 2027 roku w centrum uwagi stawiamy mobilność usług: swobodę świadczenia usług na jednolitym rynku, delegowanie pracowników i warunki, w których europejskie firmy usługowe mogą konkurować ponad granicami.',

		'aboutH1'      => 'Najważniejsze forum w Europie poświęcone',
		'aboutH2'      => 'swobodzie świadczenia usług',
		'aboutH3'      => 'i konkurencyjności jednolitego rynku.',
		'aboutBody'    => 'Kilkuset uczestników rocznie: administracja, biznes, nauka, partnerzy społeczni i politycy — z Polski, UE i spoza Wspólnoty. Dwa dni: obrady plenarne z udziałem ekspertów i decydentów oraz warsztaty praktyczne w mniejszych grupach.',
		's1'           => 'pierwsza edycja',
		's2'           => 'edycji za nami',
		's3'           => 'krajów w 2026',

		'whoH'         => 'Dla kogo jest kongres',
		'whoLead'      => 'Pięć środowisk, które co roku spotykają się przy jednym stole.',
		'who'          => array(
			array( 'title' => 'Administracja', 'desc' => 'Ministerstwa, inspekcje pracy, ZUS i instytucje łącznikowe z całej UE.' ),
			array( 'title' => 'Biznes i agencje', 'desc' => 'Firmy delegujące, agencje zatrudnienia, usługodawcy transgraniczni.' ),
			array( 'title' => 'Nauka', 'desc' => 'Badacze prawa pracy, ekonomii rynku wewnętrznego i migracji.' ),
			array( 'title' => 'Partnerzy społeczni', 'desc' => 'Związki zawodowe i organizacje pracodawców.' ),
			array( 'title' => 'Politycy', 'desc' => 'Posłowie do PE, parlamentów krajowych i przedstawiciele Komisji.' ),
		),

		'recapH'       => 'Tak było w 2026',
		'recapLink'    => 'Pełna relacja z IX edycji',
		'recapStat'    => 'krajów reprezentowanych w Warszawie',
		'recapBody'    => 'IX edycja odbyła się w Warszawie, w Crowne Plaza The HUB. Dwa dni obrad plenarnych, warsztaty Warm-Up i sesja MobileCare zgromadziły uczestników z 17 państw.',
		'recapSlots'   => array( 'Sala plenarna — szeroki kadr', 'Panel / prelegent', 'Kuluary / networking', 'Warsztat' ),

		'speakersH'    => 'Prelegenci poprzednich edycji',
		'speakersNote' => 'lista i zdjęcia — do uzupełnienia',
		'speakersBody' => 'Na scenie ELMC występowali komisarze UE, posłowie do Parlamentu Europejskiego, ministrowie, szefowie inspekcji pracy, przedsiębiorcy i badacze rynku wewnętrznego.',
		'speakerPhoto' => 'Zdjęcie prelegenta',
		'spName'       => 'Imię Nazwisko',
		'spRole'       => 'Stanowisko, organizacja',

		'cfsH'         => 'Masz temat na scenę ELMC 2027?',
		'cfsBody'      => 'Szukamy prelegentów i panelistów: praktyków, badaczy i przedstawicieli instytucji, którzy mają coś do powiedzenia o mobilności usług w Europie. Zostaw kontakt — odezwiemy się, gdy ruszy program.',
		'cfsList'      => array( 'Obrady plenarne, panele i warsztaty', 'Języki: polski i angielski', 'Zgłoszenia zbieramy do ogłoszenia programu' ),
		'fName'        => 'Imię i nazwisko',
		'fOrgPos'      => 'Organizacja / stanowisko',
		'cfsSubmit'    => 'Zgłoś się',
		'required'     => 'wszystkie pola są wymagane',
		'cfsThanksH'   => 'Dziękujemy!',
		'cfsThanksB'   => 'Twoje zgłoszenie dotarło. Odezwiemy się, gdy zaczniemy układać program edycji 2027.',

		'partKicker'   => 'Partnerstwo',
		'partH'        => 'Bądź partnerem ELMC 2027',
		'partBody'     => 'Kongres to dwa dni bezpośredniego kontaktu z decydentami, administracją i firmami z całej Europy. Oferujemy sześć poziomów partnerstwa — zakres dopasowujemy indywidualnie.',
		'partCta'      => 'Zapytaj o warunki współpracy',
		'partNote'     => 'odpowiadamy w ciągu 2 dni roboczych',
		'tiers'        => array(
			array( 'name' => 'Partner Strategiczny', 'tag' => '1 partner', 'desc' => 'Współtworzenie programu, wystąpienie w sesji otwierającej, pełna ekspozycja marki.' ),
			array( 'name' => 'Partner Główny', 'tag' => '1 partner', 'desc' => 'Udział w panelu, stoisko, ekspozycja we wszystkich materiałach.' ),
			array( 'name' => 'Partner', 'tag' => 'bez limitu', 'desc' => 'Ekspozycja marki na miejscu i w komunikacji kongresu.' ),
			array( 'name' => 'Partner Merytoryczny', 'tag' => 'sesje i warsztaty', 'desc' => 'Współprowadzenie warsztatu lub sesji tematycznej.' ),
			array( 'name' => 'Partner Instytucjonalny', 'tag' => 'instytucje', 'desc' => 'Dla instytucji publicznych i organizacji branżowych.' ),
			array( 'name' => 'Patron Medialny', 'tag' => 'media', 'desc' => 'Wymiana świadczeń promocyjnych z redakcjami i portalami.' ),
		),

		'orgLabel'     => 'Organizator',
		'orgH'         => 'Kongres organizuje Europejski Instytut Mobilności Pracy',
		'orgBody'      => 'Think tank zajmujący się od 2013 roku delegowaniem pracowników i swobodą świadczenia usług w UE. Instytut prowadzi badania, opiniuje unijne i krajowe regulacje, szkoli firmy i administrację, a raz w roku zaprasza całą branżę na ELMC.',

		'partnersH'    => 'Partnerzy',
		'partnersNote' => 'partnerzy edycji 2027 — lista w budowie',
		'logoPh'       => 'Logo partnera',
		'psod'         => 'Polskie Stowarzyszenie Opieki Domowej',

		'editionsH'    => 'Poprzednie edycje',

		// runtime: form states, consent, e-mails
		'privacyLink'  => 'Informacja o danych',
		'stCheck'      => 'Jeszcze jeden krok — sprawdź skrzynkę i kliknij link potwierdzający, który właśnie wysłaliśmy.',
		'stSuccess'    => 'Potwierdzone — dziękujemy. Damy znać, gdy ogłosimy szczegóły ELMC 2027.',
		'stUnsub'      => 'Zostałeś wypisany. Nie wyślemy już żadnych wiadomości o ELMC 2027.',
		'stError'      => 'Podaj poprawny adres e-mail.',
		'stConsent'    => 'Zaznacz zgodę, żebyśmy mogli wysyłać Ci informacje.',
		'stInvalid'    => 'Ten link jest już nieaktualny. Możesz zapisać się ponownie poniżej.',
		'cfsErrFields' => 'Uzupełnij wszystkie pola.',
		'cfsErrEmail'  => 'Podaj poprawny adres e-mail.',
		'cfsErrRodo'   => 'Zaznacz zgodę na przetwarzanie danych.',
		'mailSubject'  => 'Potwierdź zapis: powiadomienia o ELMC 2027',
		'mailLines'    => array(
			'Dzień dobry,',
			'Ktoś (mamy nadzieję, że Ty) poprosił o powiadomienia o Europejskim Kongresie Mobilności Pracy 2027 na ten adres e-mail.',
		),
		'mailConfirm'  => 'Aby potwierdzić, kliknij: ',
		'mailIgnore'   => 'Jeśli to nie Ty, po prostu zignoruj tę wiadomość — nie wyślemy nic więcej.',
		'mailUnsub'    => 'Wypisz się w każdej chwili: ',
		'mailPrivacy'  => 'Jak przetwarzamy Twoje dane: ',
		'mailSign'     => 'Europejski Kongres Mobilności Pracy',
		'docTitle'     => 'ELMC 2027 — Europejski Kongres Mobilności Pracy',
	);

	$en = array(
		'navMission'   => 'Mission',
		'navAbout'     => 'About',
		'navRecap'     => '2026 recap',
		'navSpeakers'  => 'Speakers',
		'navPartners'  => 'Partnership',
		'notify'       => 'Notify me',
		'skipToMain'   => 'Skip to content',

		'heroKicker'   => 'Next edition — in preparation',
		'heroTitle'    => 'European Labour Mobility Congress',
		'heroLead'     => 'Since 2013, ELMC has brought together Europe\'s labour mobility institutions, employment agencies and decision-makers. The 2027 edition is in preparation — leave your e-mail and we will let you know when dates are announced and registration opens.',
		'heroAlt'      => 'Mural: European Labour Mobility Congress, with “Labour” crossed out and replaced by “Service”, and the slogan “Barriers down! Europe forward!”',
		'emailPh'      => 'Your e-mail address',
		'noSpam'       => 'One message, no spam. Unsubscribe anytime.',

		'fEdition'     => 'Edition',
		'fEditionV'    => 'X — tenth',
		'fDates'       => 'Dates',
		'fPlace'       => 'Venue',
		'fOrg'         => 'Organiser',
		'tba'          => 'to be announced',
		'elmi'         => 'European Labour Mobility Institute',

		'bandBody'     => 'Fewer barriers for services and workers in the single market, more Europe in practice. We discuss posting, social security coordination and the future of the freedom to provide services.',

		'missionKicker' => 'Mission',
		'missionLead'  => 'We build a European forum where administration, business, academia and social partners discuss labour mobility without prejudice — on facts, in one place, once a year.',
		'missionBody'  => 'The freedom to provide services and the free movement of workers are the foundation of the single market — and one of the most contested fields of European politics. ELMC was created to civilise that dispute: to give practitioners a voice, confront regulation with the reality of companies and workers, and work out solutions that serve the whole Union.',
		'pillars'      => array(
			array( 'title' => 'Dialogue across divides', 'desc' => 'At one table: sending and receiving countries, employers and unions, officials and entrepreneurs.' ),
			array( 'title' => 'Facts instead of myths', 'desc' => 'Data, research and market experience as the basis of the debate on posting and mobility.' ),
			array( 'title' => 'Impact on regulation', 'desc' => 'Conclusions from the Congress reach the Commission, the European Parliament and national governments.' ),
		),

		'themeKicker'  => '2027 theme',
		'themeSlogan'  => 'There is no competitiveness without mobility.',
		'themeBody'    => 'In 2027 we put service mobility at the centre: the freedom to provide services in the single market, the posting of workers and the conditions under which European service companies can compete across borders.',

		'aboutH1'      => 'Europe\'s leading forum on the',
		'aboutH2'      => 'freedom to provide services',
		'aboutH3'      => 'and single market competitiveness.',
		'aboutBody'    => 'Several hundred participants a year: administration, business, academia, social partners and politicians — from Poland, the EU and beyond. Two days: plenary debates with experts and decision-makers, plus hands-on workshops in smaller groups.',
		's1'           => 'first edition',
		's2'           => 'editions so far',
		's3'           => 'countries in 2026',

		'whoH'         => 'Who the congress is for',
		'whoLead'      => 'Five communities that meet at one table every year.',
		'who'          => array(
			array( 'title' => 'Administration', 'desc' => 'Ministries, labour inspectorates, social security and liaison bodies across the EU.' ),
			array( 'title' => 'Business & agencies', 'desc' => 'Posting companies, employment agencies, cross-border service providers.' ),
			array( 'title' => 'Academia', 'desc' => 'Researchers in labour law, internal market economics and migration.' ),
			array( 'title' => 'Social partners', 'desc' => 'Trade unions and employers\' organisations.' ),
			array( 'title' => 'Politicians', 'desc' => 'MEPs, national parliamentarians and Commission representatives.' ),
		),

		'recapH'       => 'This was 2026',
		'recapLink'    => 'Full recap of the 9th edition',
		'recapStat'    => 'countries represented in Warsaw',
		'recapBody'    => 'The 9th edition took place in Warsaw at Crowne Plaza The HUB. Two days of plenary debates, Warm-Up workshops and the MobileCare session gathered participants from 17 countries.',
		'recapSlots'   => array( 'Plenary hall — wide shot', 'Panel / speaker', 'Networking', 'Workshop' ),

		'speakersH'    => 'Speakers of past editions',
		'speakersNote' => 'list and photos — to be completed',
		'speakersBody' => 'The ELMC stage has hosted EU Commissioners, Members of the European Parliament, ministers, heads of labour inspectorates, entrepreneurs and internal market researchers.',
		'speakerPhoto' => 'Speaker photo',
		'spName'       => 'Name Surname',
		'spRole'       => 'Position, organisation',

		'cfsH'         => 'Have a topic for the ELMC 2027 stage?',
		'cfsBody'      => 'We are looking for speakers and panellists: practitioners, researchers and institutional representatives with something to say about service mobility in Europe. Leave your contact — we will get back to you when the programme takes shape.',
		'cfsList'      => array( 'Plenary sessions, panels and workshops', 'Languages: Polish and English', 'Applications open until the programme is announced' ),
		'fName'        => 'Full name',
		'fOrgPos'      => 'Organisation / position',
		'cfsSubmit'    => 'Apply',
		'required'     => 'all fields are required',
		'cfsThanksH'   => 'Thank you!',
		'cfsThanksB'   => 'Your application has arrived. We will be in touch when we start shaping the 2027 programme.',

		'partKicker'   => 'Partnership',
		'partH'        => 'Become a partner of ELMC 2027',
		'partBody'     => 'The congress means two days of direct contact with decision-makers, administration and companies from across Europe. We offer six partnership levels — scope is tailored individually.',
		'partCta'      => 'Ask for the offer',
		'partNote'     => 'we reply within 2 working days',
		'tiers'        => array(
			array( 'name' => 'Strategic Partner', 'tag' => '1 partner', 'desc' => 'Co-creation of the programme, opening session speech, full brand exposure.' ),
			array( 'name' => 'Main Partner', 'tag' => '1 partner', 'desc' => 'Panel participation, stand, exposure in all materials.' ),
			array( 'name' => 'Partner', 'tag' => 'no limit', 'desc' => 'Brand exposure on site and in congress communication.' ),
			array( 'name' => 'Content Partner', 'tag' => 'sessions & workshops', 'desc' => 'Co-hosting a workshop or thematic session.' ),
			array( 'name' => 'Institutional Partner', 'tag' => 'institutions', 'desc' => 'For public institutions and industry organisations.' ),
			array( 'name' => 'Media Patron', 'tag' => 'media', 'desc' => 'Exchange of promotional services with media outlets.' ),
		),

		'orgLabel'     => 'Organiser',
		'orgH'         => 'The congress is organised by the European Labour Mobility Institute',
		'orgBody'      => 'A think tank working since 2013 on the posting of workers and the freedom to provide services in the EU. The Institute conducts research, comments on EU and national regulation, trains companies and administrations, and once a year brings the whole sector together at ELMC.',

		'partnersH'    => 'Partners',
		'partnersNote' => '2027 partners — list in progress',
		'logoPh'       => 'Partner logo',
		'psod'         => 'Polish Association of Homecare Providers',

		'editionsH'    => 'Past editions',

		// runtime
		'privacyLink'  => 'Privacy notice',
		'stCheck'      => 'Almost done — please check your inbox and click the confirmation link we\'ve just sent you.',
		'stSuccess'    => 'Confirmed — thank you. We\'ll let you know as soon as ELMC 2027 details are announced.',
		'stUnsub'      => 'You have been unsubscribed. You will not receive any more e-mails about ELMC 2027.',
		'stError'      => 'Please enter a valid e-mail address.',
		'stConsent'    => 'Please tick the consent box so we can send you the updates.',
		'stInvalid'    => 'This link is no longer valid. You can sign up again below.',
		'cfsErrFields' => 'Please fill in all fields.',
		'cfsErrEmail'  => 'Please enter a valid e-mail address.',
		'cfsErrRodo'   => 'Please tick the consent box.',
		'mailSubject'  => 'Please confirm: ELMC 2027 updates',
		'mailLines'    => array(
			'Hello,',
			'Someone (hopefully you) asked to be notified about the European Labour Mobility Congress 2027 using this e-mail address.',
		),
		'mailConfirm'  => 'To confirm, please click: ',
		'mailIgnore'   => 'If it was not you, simply ignore this message - you will not receive anything else.',
		'mailUnsub'    => 'Unsubscribe at any time: ',
		'mailPrivacy'  => 'Information on how we process your data: ',
		'mailSign'     => 'European Labour Mobility Congress',
		'docTitle'     => 'ELMC 2027 — European Labour Mobility Congress',
	);

	return 'en' === $lang ? $en : $pl;
}

/**
 * One string from the copy of the current (or given) language.
 */
function elmc2027_t( $key, $lang = null ) {
	$copy = elmc2027_copy( $lang );
	return isset( $copy[ $key ] ) ? $copy[ $key ] : '';
}

/**
 * Past editions, newest first. Every address was checked on 13.09.2026 and again
 * with the design handoff on 19.09.2026; 2022 is the one edition without a roman numeral.
 */
function elmc2027_editions( $lang = null ) {
	$lang = ( 'en' === $lang || 'pl' === $lang ) ? $lang : elmc2027_lang();

	$labels_pl = array(
		'IX edycja · Warszawa, Crowne Plaza The HUB', 'VIII edycja · Kraków', 'VII edycja · Kraków', 'Kraków',
		'VI edycja · Kraków', 'V edycja · Kraków', 'IV edycja · Kraków', 'III edycja · Kraków', 'II edycja · Kraków', 'I edycja · Kraków',
	);
	$labels_en = array(
		'9th edition · Warsaw, Crowne Plaza The HUB', '8th edition · Kraków', '7th edition · Kraków', 'Kraków',
		'6th edition · Kraków', '5th edition · Kraków', '4th edition · Kraków', '3rd edition · Kraków', '2nd edition · Kraków', '1st edition · Kraków',
	);
	$years  = array( '2026', '2025', '2023', '2022', '2019', '2017', '2016', '2015', '2014', '2013' );
	$romans = array( 'IX', 'VIII', 'VII', '—', 'VI', 'V', 'IV', 'III', 'II', 'I' );
	$hrefs_pl = array(
		'https://labourinstitute.eu/ekmp2026/',
		'https://labourinstitute.eu/ekmp2025/',
		'https://ekmp.pl/2023/',
		'https://ekmp.pl/2022/',
		'https://ekmp.pl/2019/',
		'https://ekmp.pl/2017/',
		'https://ekmp.pl/2016/',
		'https://ekmp.pl/2015/',
		'https://ekmp.pl/2014/',
		'https://ekmp.pl/2013/',
	);
	// English archives exist under elmc.eu for 2014, 2015, 2016 and 2022 only (checked 19.09.2026);
	// 2013, 2017, 2019 and 2023 have Polish versions only.
	$hrefs_en = array(
		'https://labourinstitute.eu/en/elmc2026/',
		'https://labourinstitute.eu/en/elmc2025/',
		'https://ekmp.pl/2023/',
		'https://www.elmc.eu/2022/',
		'https://ekmp.pl/2019/',
		'https://ekmp.pl/2017/',
		'https://www.elmc.eu/2016/',
		'https://www.elmc.eu/2015/',
		'https://www.elmc.eu/2014/',
		'https://ekmp.pl/2013/',
	);

	$hrefs    = 'en' === $lang ? $hrefs_en : $hrefs_pl;
	$labels   = 'en' === $lang ? $labels_en : $labels_pl;
	$editions = array();
	foreach ( $years as $i => $year ) {
		$editions[] = array(
			'year'  => $year,
			'roman' => $romans[ $i ],
			'label' => $labels[ $i ],
			'href'  => $hrefs[ $i ],
		);
	}
	return $editions;
}

/**
 * Partnership tier markers: the ranking is carried by the marker size, colour and shape.
 */
function elmc2027_tier_marks() {
	return array(
		array( 'color' => '#E9961F', 'dot' => '28px', 'radius' => '0', 'size' => '30px' ),
		array( 'color' => '#3E63C9', 'dot' => '24px', 'radius' => '0', 'size' => '26px' ),
		array( 'color' => '#ffffff', 'dot' => '20px', 'radius' => '0', 'size' => '22px' ),
		array( 'color' => '#E9961F', 'dot' => '18px', 'radius' => '999px', 'size' => '20px' ),
		array( 'color' => '#3E63C9', 'dot' => '18px', 'radius' => '999px', 'size' => '20px' ),
		array( 'color' => 'rgba(255,255,255,.55)', 'dot' => '18px', 'radius' => '999px', 'size' => '20px' ),
	);
}

/**
 * Speakers of past editions - eight empty slots until real names and photos arrive.
 * Deliberately no invented people: the placeholder name is the same in every card.
 */
function elmc2027_speaker_years() {
	return array( 2026, 2026, 2026, 2025, 2025, 2023, 2023, 2019 );
}

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
		'navAbout'     => 'O Kongresie',
		'navRecap'     => 'Relacja 2026',
		'navSpeakers'  => 'Prelegenci',
		'navPartners'  => 'Partnerstwo',
		'notify'       => 'Powiadom mnie',
		'skipToMain'   => 'Przejdź do treści',
		'menu'         => 'Menu',

		'heroKicker'   => 'Kolejna edycja – w przygotowaniu',
		'heroTitle'    => 'Europejski Kongres Mobilności Pracy',
		'heroLead'     => 'Od 2013 roku ELMC łączy administrację, biznes, naukę, partnerów społecznych i decydentów z całej Europy. Zostaw e-mail – powiadomimy Cię, gdy ogłosimy daty edycji 2027 i otworzymy rejestrację.',
		'heroAlt'      => 'Mural: European Labour Mobility Congress, z przekreślonym słowem „Labour” i dopisanym „Service”, oraz hasłem „Barriers down! Europe forward!”',
		'emailPh'      => 'Twój adres e-mail',
		'noSpam'       => 'Tylko informacje o ELMC 2027, bez spamu. Możesz wypisać się w każdej chwili.',

		'fEdition'     => 'Edycja',
		'fEditionV'    => 'X – dziesiąta',
		'fDates'       => 'Daty',
		'fPlace'       => 'Miejsce',
		'fPlaceV'      => 'ICE Kraków',
		'fOrg'         => 'Organizator',
		'tba'          => 'do ogłoszenia',
		'elmi'         => 'Europejski Instytut Mobilności Pracy',

		'bandBody'     => 'Mniej barier dla usług i pracowników na jednym europejskim rynku, więcej Europy w praktyce. Rozmawiamy o delegowaniu pracowników, koordynacji zabezpieczenia społecznego i przyszłości swobody świadczenia usług.',

		'missionKicker' => 'Misja',
		'missionLead'  => 'Budujemy europejskie forum, na którym administracja, biznes, nauka i partnerzy społeczni rozmawiają o mobilności pracy bez uprzedzeń – na faktach, w jednym miejscu, raz w roku.',
		'missionBody'  => 'Swoboda świadczenia usług i przepływu pracowników to fundament jednego europejskiego rynku, a zarazem jedno z najbardziej spornych pól europejskiej polityki. ELMC powstał, by ten spór ucywilizować: dać głos praktykom, skonfrontować regulacje z rzeczywistością firm i pracowników oraz wypracować rozwiązania, które służą całej Unii.',
		'pillars'      => array(
			array( 'title' => 'Dialog ponad podziałami', 'desc' => 'Przy jednym stole: kraje wysyłające i przyjmujące, pracodawcy i związki, urzędnicy i przedsiębiorcy.' ),
			array( 'title' => 'Fakty zamiast mitów', 'desc' => 'Dane, badania i doświadczenia z rynku jako podstawa rozmowy o delegowaniu i mobilności.' ),
			array( 'title' => 'Wpływ na regulacje', 'desc' => 'Wnioski z Kongresu trafiają do Komisji Europejskiej, Parlamentu Europejskiego i rządów krajowych.' ),
		),

		'themeKicker'  => 'Temat edycji 2027',
		'themeSlogan'  => 'Nie ma konkurencyjności bez mobilności.',
		'themeBody'    => 'W 2027 roku – roku, w którym Unia ma zrealizować plan „Jedna Europa, jeden rynek” – w centrum uwagi stawiamy mobilność usług: swobodę świadczenia usług na jednym europejskim rynku, delegowanie pracowników i warunki, w których europejscy usługodawcy mogą konkurować ponad granicami.',

		'aboutH1'      => 'Najważniejsze forum w Europie poświęcone',
		'aboutH2'      => 'swobodzie świadczenia usług',
		'aboutH3'      => 'i konkurencyjności jednego europejskiego rynku.',
		'aboutBody'    => 'Kilkuset uczestników na każdej edycji: administracja, biznes, nauka, partnerzy społeczni i politycy – z Polski, z całej UE i spoza niej. Dwa dni: obrady plenarne z udziałem ekspertów i decydentów oraz praktyczne warsztaty w mniejszych grupach.',
		's1'           => 'pierwsza edycja',
		's2'           => 'edycji za nami',
		's3'           => 'krajów wśród uczestników w 2026',

		'whoH'         => 'Dla kogo jest Kongres',
		'whoLead'      => 'Pięć środowisk, które co roku spotykają się przy jednym stole.',
		'who'          => array(
			array( 'title' => 'Administracja', 'desc' => 'Ministerstwa, inspekcje pracy, instytucje zabezpieczenia społecznego i instytucje łącznikowe z całej UE.' ),
			array( 'title' => 'Biznes i agencje', 'desc' => 'Eksporterzy usług, firmy delegujące pracowników, agencje zatrudnienia.' ),
			array( 'title' => 'Nauka', 'desc' => 'Badacze prawa pracy, ekonomii rynku wewnętrznego i migracji.' ),
			array( 'title' => 'Partnerzy społeczni', 'desc' => 'Związki zawodowe i organizacje pracodawców.' ),
			array( 'title' => 'Politycy', 'desc' => 'Posłowie do Parlamentu Europejskiego i parlamentów krajowych, przedstawiciele Komisji Europejskiej.' ),
		),

		'recapH'       => 'Tak było w 2026',
		'recapLink'    => 'Pełna relacja z IX edycji',
		'recapStat'    => 'krajów, z których przyjechali uczestnicy',
		'recapBody'    => 'IX edycja odbyła się w Warszawie, w hotelu Crowne Plaza Warsaw – The HUB. Dwa dni obrad plenarnych, warsztaty Warm-Up i sesja MobileCare zgromadziły uczestników z 17 krajów.',
		'recapSlots'   => array( 'Sala plenarna – szeroki kadr', 'Panel / prelegent', 'Kuluary / networking', 'Warsztat' ),

		'speakersH'    => 'Prelegenci poprzednich edycji',
		'speakersNote' => 'lista i zdjęcia – do uzupełnienia',
		'speakersBody' => 'Na scenie ELMC występowali komisarze UE, posłowie do Parlamentu Europejskiego, ministrowie, szefowie inspekcji pracy, przedsiębiorcy i badacze europejskiego rynku usług.',
		'speakerPhoto' => 'Zdjęcie prelegenta',
		'spName'       => 'Imię Nazwisko',
		'spRole'       => 'Stanowisko, organizacja',

		'cfsH'         => 'Masz temat na scenę ELMC 2027?',
		'cfsBody'      => 'Szukamy prelegentów i panelistów: praktyków, badaczy i przedstawicieli instytucji, którzy mają coś do powiedzenia o mobilności usług w Europie. Zostaw dane kontaktowe – odezwiemy się, gdy zaczniemy układać program.',
		'cfsList'      => array( 'Obrady plenarne, panele i warsztaty', 'Języki: polski i angielski', 'Zgłoszenia zbieramy do ogłoszenia programu' ),
		'fName'        => 'Imię i nazwisko',
		'fOrgPos'      => 'Organizacja / stanowisko',
		'fTopic'       => 'Temat lub obszar, o którym chcesz mówić (opcjonalnie)',
		'cfsSubmit'    => 'Zgłoś się',
		'required'     => 'pola oznaczone * są wymagane',
		'cfsThanksH'   => 'Dziękujemy!',
		'cfsThanksB'   => 'Twoje zgłoszenie dotarło. Odezwiemy się, gdy zaczniemy układać program edycji 2027.',

		'partKicker'   => 'Partnerstwo',
		'partH'        => 'Zostań Partnerem ELMC 2027',
		'partBody'     => 'Kongres to dwa dni bezpośredniego kontaktu z decydentami, administracją i firmami z całej Europy. Oferujemy sześć form partnerstwa – zakres ustalamy indywidualnie.',
		'partCta'      => 'Zapytaj o warunki współpracy',
		'partNote'     => 'odpowiadamy w ciągu 2 dni roboczych',
		'tiers'        => array(
			array( 'name' => 'Partner Strategiczny', 'tag' => '1 partner', 'desc' => 'Udział w pracach nad programem, wystąpienie w sesji otwierającej, pełna ekspozycja marki.' ),
			array( 'name' => 'Partner Główny', 'tag' => '1 partner', 'desc' => 'Udział w panelu, stoisko, ekspozycja we wszystkich materiałach.' ),
			array( 'name' => 'Partner', 'tag' => 'bez limitu', 'desc' => 'Ekspozycja marki na miejscu i w komunikacji Kongresu.' ),
			array( 'name' => 'Partner Merytoryczny', 'tag' => 'sesje i warsztaty', 'desc' => 'Współprowadzenie warsztatu lub sesji tematycznej.' ),
			array( 'name' => 'Partner Instytucjonalny', 'tag' => 'instytucje', 'desc' => 'Dla instytucji publicznych i organizacji branżowych.' ),
			array( 'name' => 'Patron Medialny', 'tag' => 'media', 'desc' => 'Współpraca promocyjna z redakcjami i portalami.' ),
		),

		'orgLabel'     => 'Organizator',
		'orgH'         => 'Kongres organizuje Europejski Instytut Mobilności Pracy',
		'orgBody'      => 'Think tank zajmujący się od 2013 roku delegowaniem pracowników i swobodą świadczenia usług w UE. Instytut prowadzi badania, opiniuje unijne i krajowe regulacje, szkoli firmy i administrację, a raz w roku zaprasza wszystkie te środowiska na ELMC.',

		'partnersH'    => 'Partnerzy',
		'partnersNote' => 'partnerzy edycji 2027 – lista w budowie',
		'logoPh'       => 'Logo partnera',
		'psod'         => 'Polskie Stowarzyszenie Opieki Domowej',

		'editionsH'    => 'Poprzednie edycje',

		// runtime: form states, consent, e-mails
		'privacyLink'  => 'Informacja o danych',
		'stCheck'      => 'Jeszcze jeden krok – sprawdź skrzynkę i kliknij link potwierdzający, który właśnie wysłaliśmy.',
		'stSuccess'    => 'Potwierdzone – dziękujemy. Damy znać, gdy ogłosimy szczegóły ELMC 2027.',
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
		'mailIgnore'   => 'Jeśli to nie Ty, po prostu zignoruj tę wiadomość – nie wyślemy nic więcej.',
		'mailUnsub'    => 'Wypisz się w każdej chwili: ',
		'mailPrivacy'  => 'Jak przetwarzamy Twoje dane: ',
		'mailSign'     => 'Europejski Kongres Mobilności Pracy',
		'docTitle'     => 'ELMC 2027 – Europejski Kongres Mobilności Pracy',
		'metaDesc'     => 'ELMC – Europejski Kongres Mobilności Pracy. Od 2013 roku forum o swobodzie świadczenia usług i delegowaniu pracowników w UE. Edycja 2027: zapisz się na powiadomienia.',
	);

	$en = array(
		'navMission'   => 'Mission',
		'navAbout'     => 'About',
		'navRecap'     => '2026 recap',
		'navSpeakers'  => 'Speakers',
		'navPartners'  => 'Partnership',
		'notify'       => 'Notify me',
		'skipToMain'   => 'Skip to content',
		'menu'         => 'Menu',

		'heroKicker'   => 'Next edition – in preparation',
		'heroTitle'    => 'European Labour Mobility Congress',
		'heroLead'     => 'Since 2013, ELMC has brought together public administration, business, academia, social partners and decision-makers from across Europe. Leave your email address and we will let you know when the 2027 dates are announced and registration opens.',
		'heroAlt'      => 'Mural: European Labour Mobility Congress, with “Labour” crossed out and replaced by “Service”, and the slogan “Barriers down! Europe forward!”',
		'emailPh'      => 'Your email address',
		'noSpam'       => 'ELMC 2027 updates only, no spam. You can unsubscribe at any time.',

		'fEdition'     => 'Edition',
		'fEditionV'    => 'X – tenth',
		'fDates'       => 'Dates',
		'fPlace'       => 'Venue',
		'fPlaceV'      => 'ICE Kraków Congress Centre',
		'fOrg'         => 'Organiser',
		'tba'          => 'to be announced',
		'elmi'         => 'European Labour Mobility Institute',

		'bandBody'     => 'Fewer barriers for services and workers in one European market, more Europe in practice. We discuss the posting of workers, social security coordination and the future of the freedom to provide services.',

		'missionKicker' => 'Mission',
		'missionLead'  => 'We are building a European forum where public administration, business, academia and social partners discuss labour mobility with an open mind – based on facts, in one place, once a year.',
		'missionBody'  => 'The freedom to provide services and the free movement of workers are a foundation of the Single Market – and one of the most contested areas of European policy. ELMC was created to put that debate on civil, factual ground: to give practitioners a voice, to test regulation against the reality of companies and workers, and to work out solutions that serve the whole Union.',
		'pillars'      => array(
			array( 'title' => 'Dialogue across divides', 'desc' => 'At one table: sending and receiving countries, employers and trade unions, officials and entrepreneurs.' ),
			array( 'title' => 'Facts, not myths', 'desc' => 'Data, research and market experience as the basis for the debate on posting and mobility.' ),
			array( 'title' => 'Impact on regulation', 'desc' => 'Conclusions from the Congress reach the European Commission, the European Parliament and national governments.' ),
		),

		'themeKicker'  => '2027 theme',
		'themeSlogan'  => 'There is no competitiveness without mobility.',
		'themeBody'    => 'In 2027 – the year in which the EU is due to deliver its "One Europe, One Market" roadmap – we put the mobility of services at the centre: the freedom to provide services in one European market, the posting of workers and the conditions under which European service providers can compete across borders.',

		'aboutH1'      => 'Europe\'s leading forum on the',
		'aboutH2'      => 'freedom to provide services',
		'aboutH3'      => 'and the competitiveness of one European market.',
		'aboutBody'    => 'Several hundred participants at each edition: public administration, business, academia, social partners and politicians – from Poland, across the EU and beyond. Two days: plenary debates with experts and decision-makers, plus hands-on workshops in smaller groups.',
		's1'           => 'first edition',
		's2'           => 'editions so far',
		's3'           => 'countries among participants in 2026',

		'whoH'         => 'Who the Congress is for',
		'whoLead'      => 'Five communities that meet at one table every year.',
		'who'          => array(
			array( 'title' => 'Public administration', 'desc' => 'Ministries, labour inspectorates, social security institutions and liaison bodies from across the EU.' ),
			array( 'title' => 'Business & agencies', 'desc' => 'Service exporters, companies posting workers, employment agencies.' ),
			array( 'title' => 'Academia', 'desc' => 'Researchers in labour law, internal market economics and migration.' ),
			array( 'title' => 'Social partners', 'desc' => 'Trade unions and employers\' organisations.' ),
			array( 'title' => 'Politicians', 'desc' => 'MEPs, members of national parliaments and European Commission representatives.' ),
		),

		'recapH'       => 'Looking back at 2026',
		'recapLink'    => 'Full recap of the 9th edition',
		'recapStat'    => 'countries participants came from',
		'recapBody'    => 'The 9th edition took place in Warsaw, at the Crowne Plaza Warsaw – The HUB hotel. Two days of plenary debates, the Warm-Up workshops and the MobileCare session brought together participants from 17 countries.',
		'recapSlots'   => array( 'Plenary hall – wide shot', 'Panel / speaker', 'Networking', 'Workshop' ),

		'speakersH'    => 'Speakers at past editions',
		'speakersNote' => 'list and photos – to be completed',
		'speakersBody' => 'The ELMC stage has hosted EU Commissioners, Members of the European Parliament, ministers, heads of labour inspectorates, entrepreneurs and researchers specialising in the European market for services.',
		'speakerPhoto' => 'Speaker photo',
		'spName'       => 'Name Surname',
		'spRole'       => 'Position, organisation',

		'cfsH'         => 'Do you have a topic for the ELMC 2027 stage?',
		'cfsBody'      => 'We are looking for speakers and panellists: practitioners, researchers and institutional representatives with something to say about the mobility of services in Europe. Leave your contact details – we will get back to you when we start shaping the programme.',
		'cfsList'      => array( 'Plenary sessions, panels and workshops', 'Languages: Polish and English', 'Applications are open until the programme is announced' ),
		'fName'        => 'Full name',
		'fOrgPos'      => 'Organisation / position',
		'fTopic'       => 'Topic or area you would like to speak about (optional)',
		'cfsSubmit'    => 'Apply',
		'required'     => 'fields marked * are required',
		'cfsThanksH'   => 'Thank you!',
		'cfsThanksB'   => 'We have received your application. We will be in touch when we start shaping the 2027 programme.',

		'partKicker'   => 'Partnership',
		'partH'        => 'Become a Partner of ELMC 2027',
		'partBody'     => 'The Congress offers two days of direct contact with decision-makers, public administration and companies from across Europe. We offer six forms of partnership – the scope is agreed individually with each Partner.',
		'partCta'      => 'Ask about partnership terms',
		'partNote'     => 'we reply within 2 working days',
		'tiers'        => array(
			array( 'name' => 'Strategic Partner', 'tag' => '1 partner', 'desc' => 'Input into the programme, a speech in the opening session, full brand exposure.' ),
			array( 'name' => 'Main Partner', 'tag' => '1 partner', 'desc' => 'A seat on a panel, an exhibition stand, exposure in all materials.' ),
			array( 'name' => 'Partner', 'tag' => 'no limit', 'desc' => 'Brand exposure on site and in Congress communications.' ),
			array( 'name' => 'Knowledge Partner', 'tag' => 'sessions & workshops', 'desc' => 'Co-hosting a workshop or a thematic session.' ),
			array( 'name' => 'Institutional Partner', 'tag' => 'institutions', 'desc' => 'For public institutions and industry organisations.' ),
			array( 'name' => 'Media Partner', 'tag' => 'media', 'desc' => 'Cross-promotion with newsrooms and online portals.' ),
		),

		'orgLabel'     => 'Organiser',
		'orgH'         => 'The Congress is organised by the European Labour Mobility Institute',
		'orgBody'      => 'A think tank that has worked since 2013 on the posting of workers and the freedom to provide services in the EU. The Institute conducts research, issues opinions on EU and national legislation, trains companies and public administration, and once a year brings all these communities together at ELMC.',

		'partnersH'    => 'Partners',
		'partnersNote' => '2027 partners – list in progress',
		'logoPh'       => 'Partner logo',
		'psod'         => 'Polish Association of Homecare Providers',

		'editionsH'    => 'Past editions',

		// runtime
		'privacyLink'  => 'Privacy notice',
		'stCheck'      => 'Almost done – please check your inbox and click the confirmation link we\'ve just sent you.',
		'stSuccess'    => 'Confirmed – thank you. We\'ll let you know as soon as ELMC 2027 details are announced.',
		'stUnsub'      => 'You have been unsubscribed. You will not receive any more emails about ELMC 2027.',
		'stError'      => 'Please enter a valid email address.',
		'stConsent'    => 'Please tick the consent box so we can send you the updates.',
		'stInvalid'    => 'This link is no longer valid. You can sign up again below.',
		'cfsErrFields' => 'Please fill in all fields.',
		'cfsErrEmail'  => 'Please enter a valid email address.',
		'cfsErrRodo'   => 'Please tick the consent box.',
		'mailSubject'  => 'Please confirm: ELMC 2027 updates',
		'mailLines'    => array(
			'Hello,',
			'Someone (hopefully you) asked to be notified about the European Labour Mobility Congress 2027 using this email address.',
		),
		'mailConfirm'  => 'To confirm, please click: ',
		'mailIgnore'   => 'If it was not you, simply ignore this message - you will not receive anything else.',
		'mailUnsub'    => 'Unsubscribe at any time: ',
		'mailPrivacy'  => 'Information on how we process your data: ',
		'mailSign'     => 'European Labour Mobility Congress',
		'docTitle'     => 'ELMC 2027 – European Labour Mobility Congress',
		'metaDesc'     => 'ELMC – European Labour Mobility Congress. Since 2013, the forum on the freedom to provide services and the posting of workers in the EU. 2027 edition: get notified.',
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
 * with the design handoff on 19.09.2026; 2022 was removed on 22.09.2026: it was the 7th edition, moved from February 2022 to April 2023 (the ekmp.pl/2022/ archive stays online).
 */
function elmc2027_editions( $lang = null ) {
	$lang = ( 'en' === $lang || 'pl' === $lang ) ? $lang : elmc2027_lang();

	$labels_pl = array(
		'IX edycja · Warszawa, Crowne Plaza The HUB', 'VIII edycja · Kraków', 'VII edycja · Kraków',
		'VI edycja · Kraków', 'V edycja · Kraków', 'IV edycja · Kraków', 'III edycja · Kraków', 'II edycja · Kraków', 'I edycja · Kraków',
	);
	$labels_en = array(
		'9th edition · Warsaw, Crowne Plaza The HUB', '8th edition · Kraków', '7th edition · Kraków',
		'6th edition · Kraków', '5th edition · Kraków', '4th edition · Kraków', '3rd edition · Kraków', '2nd edition · Kraków', '1st edition · Kraków',
	);
	$years  = array( '2026', '2025', '2023', '2019', '2017', '2016', '2015', '2014', '2013' );
	$romans = array( 'IX', 'VIII', 'VII', 'VI', 'V', 'IV', 'III', 'II', 'I' );
	$hrefs_pl = array(
		'https://labourinstitute.eu/ekmp2026/',
		'https://labourinstitute.eu/ekmp2025/',
		'https://ekmp.pl/2023/',
		'https://ekmp.pl/2019/',
		'https://ekmp.pl/2017/',
		'https://ekmp.pl/2016/',
		'https://ekmp.pl/2015/',
		'https://ekmp.pl/2014/',
		'https://ekmp.pl/2013/',
	);
	// English archives exist under elmc.eu for 2014, 2015 and 2016 only (checked 19.09.2026);
	// 2013, 2017, 2019 and 2023 have Polish versions only.
	$hrefs_en = array(
		'https://labourinstitute.eu/en/elmc2026/',
		'https://labourinstitute.eu/en/elmc2025/',
		'https://ekmp.pl/2023/',
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

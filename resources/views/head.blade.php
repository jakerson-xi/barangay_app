<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BARANGAY SOUTH SIGNAL VILLAGE</title>
  <link rel="icon" href="{{asset('assets/imgs/southsignalLogoLeft.png')}}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="{{asset('css/head.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <style>
    .groupBoxHeader {
      padding: 0.2em 0.5em;
      border: 1px solid rgb(255, 255, 255);
      font-size: 100%;
      text-align: center;
      width: auto;
      border-radius: 6px;
      background-color: rgba(192, 1, 1, 0.932);
      color: white;
      font-weight: bold;
      margin-top: 5%;
      margin-bottom: 5%;

    }

    .custom-modal .nav-tabs .nav-link {
      background-color: rgba(191, 190, 190, 0);
      /* Change to your desired background color */
      border-color: rgba(191, 190, 190, 0);
      color: black;
      /* Change to your desired text color */
    }

    .custom-modal .nav-tabs .nav-link.active {
      background-color: rgba(192, 1, 1, 0.932);
      border-color: rgba(192, 1, 1, 0.932);
      /* Change to your desired background color */
      /* Change to your desired text color */
      color: white;
    }

    .custom-modal .nav-link:hover {
      background-color: rgba(192, 1, 1, 0.932);
      border-color: rgba(192, 1, 1, 0.932);
      color: white;
    }

    .custom-modal p {
      text-align: justify;
      margin: 2px;
    }
  </style>
  <style>
    .row.justify-content-between {
      display: flex;
      justify-content: space-between;
    }

    /* Default size for the images and h1 */
    .img-logo {
      width: 125px;
    }

    .img-logo1 {
      width: 105px;
    }

    .display-6 {
      font-weight: bold;
      font-size: 2rem;
    }

    /* Adjust the size for smaller screens */
    @media screen and (max-width: 576px) {
      .img-logo {
        width: 95px;
      }

      .img-logo1 {
        width: 75px;
      }

      .display-6 {
        font-size: 1.25rem;
      }
    }

    /* Adjust the size for larger screens */
    @media screen and (min-width: 992px) {
      .img-logo {
        width: 150px;
      }

      .display-6 {
        font-size: 2.5rem;
      }
    }
  </style>

</head>

<body>
  @include('sweetalert::alert')

  <header>
    <!-- <div class="container">
      <div class="row mt-2">
        <div class="col-2">
          <img src="{{asset('assets/imgs/southsignalLogoLeft.png')}}" alt="Barangay South SIgnal Village Logo" class="rounded float-start" alt="southsignal" style="width: 125px ;">
        </div>
        <div class="col-8 text-center mt-3">

          <h1 class="display-6 d-inline-block align-text-top font-weight-bold" style="font-weight: bold;">BARANGAY SOUTH SIGNAL VILLAGE </h1>

        </div>

        <div class="col-2">
          <img src="{{asset('assets/imgs/taguig_logo.png')}}" class="rounded float-end me-3" alt="Taguig Logo" style="width: 100px ;">
        </div>
      </div>

    </div> -->

    <div class="container-fluid ">
      <div class="row mt-2">
        <div class="col-2   justify-content-start">
          <img src="{{asset('assets/imgs/southsignalLogoLeft.png')}}" alt="Barangay South Signal Village Logo" class="rounded float-start img-logo" alt="southsignal">
        </div>
        <div class="col-8 text-center mt-3">
          <h1 class="display-6 d-inline-block align-text-top font-weight-bold">BARANGAY SOUTH SIGNAL VILLAGE
          </h1>
        </div>
        <div class="col-2  justify-content-end">
          <img src="{{asset('assets/imgs/taguig_logo.png')}}" class="rounded float-end me-3 img-logo1" alt="Taguig Logo">
        </div>
      </div>
    </div>


    <div class="mt-md-1" style="background-color: #AA0F0A;">
      <nav class="mx-3 navbar navbar-expand-lg navbar-light flex-column flex-sm-row">
        <div class="container-fluid my-container-fluid">
          <button style="background-color:#AA0F0A; border-color: white;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon btn-close-white"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto topnav">
              <li class="nav-item mx-4  active ">
                <a class="nav-link" aria-current="page" href="home" style="color: white;">HOME</a>
              </li>
              <li class="nav-item dropdown mx-4">
                <a style="color: white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  SERVICES
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="login">Online Services</a></li>
                  <li>
                    <a href="#askingLegal" data-bs-toggle="modal" data-target="#askingLegal" class="dropdown-item">Register</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="requirements">Requirements</a>
                  </li>
                  <li>
                    <!-- <hr class="dropdown-divider">
                  <li>
                    <a class="dropdown-item" href="track">Track Request</a>
                  </li> -->
                </ul>
              </li>
              <li class="nav-item mx-4  active ">
                <a class="nav-link" aria-current="page" href="contact" style="color: white;">CONTACTS</a>
              </li>
              <li class="nav-item mx-4  active ">
                <a class="nav-link" aria-current="page" href="safetySection" style="color: white;">SAFETY SECTION</a>
              </li>
              <li class="nav-item mx-4  active ">
                <a class="nav-link" aria-current="page" href="aboutUs" style="color: white;">ABOUT
                  US</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>


    <!-- Modal for asking 18 years old-->
    <div class="modal fade" id="askingLegal" tabindex="-1" aria-labelledby="askingLegalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-circle"></i>
              Confirm Age Requirement</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="width: auto">
            <div class="text-center">
              <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
            </div>
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-english-tab" data-bs-toggle="tab" data-bs-target="#nav-english" type="button" role="tab" aria-controls="nav-english" aria-selected="true">
                  English
                </button>
                <button class="nav-link" id="nav-tagalog-tab" data-bs-toggle="tab" data-bs-target="#nav-tagalog" type="button" role="tab" aria-controls="nav-tagalog" aria-selected="false">
                  Tagalog
                </button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-english" role="tabpanel" aria-labelledby="nav-english-tab" tabindex="0">
                <div>
                  <p class="m-2">
                    This barangay online service is only available to users who
                    are <strong>18 years old and above</strong>. By registering
                    for this app, you confirm that you are of legal age. If you
                    are not yet 18 years old, please do not proceed with
                    registration. <br /><br />Thank you for your understanding.
                  </p>
                </div>
              </div>
              <!--Nav Tab Tagalog-->
              <div class="tab-pane fade" id="nav-tagalog" role="tabpanel" aria-labelledby="nav-tagalog-tab" tabindex="0">

                <div>
                  <p class="m-2">
                  Ang online na serbisyong ito ng barangay ay para lamang sa mga gumagamit na
                  <strong>18 taong gulang pataas</strong>. Sa pamamagitan ng pagpaparehistro sa app na
                  ito, kinukumpirma mo na ikaw ay nasa wastong edad. Kung hindi ka pa 18 taong gulang,
                  huwag kang magpatuloy sa pagpaparehistro. <br /><br />Salamat sa iyong pang-unawa.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="#dataPrivacy" data-bs-toggle="modal" data-target="#dataPrivacy" style="background-color: #AA0F0A; color:white" class="btn ">Yes, I'm 18 years old and
              above</a>
          </div>
        </div>
      </div>
    </div>

    <!--DATA POLICY-->
    <div class="modal " id="dataPrivacy" tabindex="-1" aria-labelledby="dataPrivacyLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content custom-modal">
          <div class="modal-header">
            <h5 class="modal-title" id="termsConditionsLabel" style="text-align: center;">Privacy Policy of Barangay South Signal Village </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body " style="width: auto;">
            <div class="text-center">
              <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
            </div>
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-english-pol-tab" data-bs-toggle="tab" data-bs-target="#nav-english-pol" type="button" role="tab" aria-controls="nav-english" aria-selected="true">English</button>
                <button class="nav-link" id="nav-tagalog-pol-tab" data-bs-toggle="tab" data-bs-target="#nav-tagalog-pol" type="button" role="tab" aria-controls="nav-tagalog" aria-selected="false">Tagalog</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-english-pol" role="tabpanel" aria-labelledby="nav-english-tab" tabindex="0">
                <h3 class="groupBoxHeader">Introduction</h3>
                <div>
                  <p>At Barangay South Signal Village, we recognize the importance of protecting
                    yourpersonal data and privacy. We are committed to maintaining the
                    confidentiality and limiting any disclosure of your information in accordance
                    with local laws. This Privacy Policy outlines how we collect, use, share, and
                    protect your personal information when you use our web app.</p>
                </div>
                <hr style="background-color: #AA0F0A;">
                <h3 class="groupBoxHeader">Your Rights and Preferences</h3>
                <div>
                  <p>As an individual, you have certain rights under applicable law with regard to
                    your
                    personal data.
                    These
                    include:</p>
                  <ul>
                    <li>Right of Access - the right to request access to your personal data and be
                      informed about the
                      processing
                      of your personal data;</li>
                    <li>Right to Erasure - the right to request the deletion of your personal data;
                    </li>
                    <li>Right to Restrict Processing - the right to request the restriction of
                      processing of your personal
                      data;
                    </li>
                    <li>Right to Object - the right to object to the processing of your personal
                      data;
                    </li>
                    <li>Right to Data Portability - the right to receive your personal data in a
                      structured, commonly
                      used, and
                      machine-readable format.</li>
                  </ul>
                </div>
                <hr style="background-color: #AA0F0A;">
                <h3 class="groupBoxHeader">How we Collect your Personal Data</h3>
                <div>
                  <p>We collect your personal data in the following ways:</p>
                  <p> These are the following data needed upon registering, with the corresponding
                    purpose:</p>
                  <ul>
                    <li>Full Name – to properly identify the right person when conducting the
                      registration.</li>
                    <li>Suffix – to know if person have any suffix in their name.</li>
                    <li>Gender – to classify the person based on their sexuality on birth.</li>
                    <li>Civil Status – to describe a person’s relationship with a significant other.
                    </li>
                    <li>Nationality – legal identification of a person in international law and
                      distinguished from
                      citizenship.
                    </li>
                    <li>Birthdate – used for proper identification and in case multiple persons have
                      the
                      same name.</li>
                    <li>Age – to determine the age of the person.</li>
                    <li>Place of Birth – to know where the person was born in.</li>
                    <li>Address – to determine the exact location of the person by the authorities.
                    </li>
                    <li>Valid ID – to validate all the information set by the user.</li>
                    <li>ID Number – to ensure that no two people within the system share the same
                      number.</li>
                    <li>Email – for the system to have an option to have different identification
                      aside
                      from mobile
                      number.</li>
                    <li>Mobile Number – used for unique identification in the system and for the
                      user to
                      be contacted if
                      needed
                      by the barangay officials.</li>
                  </ul>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">What do we use your Personal Data for?</h3>
                <div>
                  <p>We use your personal data to provide and improve our services to you. This
                    includes:
                  </p>
                  <ul>
                    <li>To communicate with you about our services and provide customer support.
                    </li>
                    <li>To process transactions to our services.</li>
                    <li>To improve our services and develop new features.</li>
                    <li>To comply with legal obligations.</li>
                  </ul>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Sharing your Personal Data</h3>
                <div>
                  <p>We do not sell, rent, or lease your personal information to third parties without
                    your consent. We
                    may share
                    your personal data with third-party service providers who help us operate our
                    web
                    app or provide
                    services to
                    you. These service providers are required to maintain the confidentiality and
                    security of your
                    personal
                    data. </p>
                  <p>We may also disclose your personal data if required by law, court order, or other
                    legal processes or
                    if we
                    have a good faith belief that such disclosure is necessary to protect our rights
                    or
                    property or the
                    safety
                    of others. </p>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Data Retention and Deletion </h3>
                <div>
                  <p>We keep your personal data only for as long as necessary to provide you with our
                    services and for
                    legitimate
                    and essential business purposes, such as complying with legal obligations and
                    resolving disputes. We
                    will
                    securely delete or anonymize your personal data when it is no longer needed for
                    these purposes. </p>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Keeping your Data Safe </h3>
                <div>
                  <p>We take appropriate technical and organizational measures to protect your
                    personal
                    data against
                    unauthorized
                    or unlawful processing, accidental loss, destruction, or damage. We also
                    implement
                    access controls,
                    encryption, and retention policies to protect your personal data. </p>
                </div>
              </div>
              <!--Nav Tab Tagalog-->
              <div class="tab-pane fade" id="nav-tagalog-pol" role="tabpanel" aria-labelledby="nav-tagalog-tab" tabindex="0">
                <h3 class="groupBoxHeader">Panimula</h3>
                <div>
                  <p>Sa Barangay South Signal Village, kami ay kumikilala sa kahalagahan ng
                    pagprotekta sa
                    iyong
                    personal
                    na
                    datos at
                    privacy. Kami ay mayroong pangako na panatilihing konpidensyal ang iyong
                    impormasyon
                    at limitahan
                    ang
                    anumang pagpapahayag ng iyong
                    impormasyon ayon sa mga lokal na batas. Ang Polisiya ng Privacy na ito ay
                    naglalayong ipakita kung
                    paano
                    namin kinokolekta, ginagamit, ini-share, at
                    iniingatan ang iyong personal na impormasyon kapag ginagamit mo ang aming web
                    app.
                  </p>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Ang Iyong Mga Karapatan at mga Nais</h3>
                <div>
                  <p>Bilang isang indibidwal, mayroon kang mga karagdagang karapatan sa ilalim ng mga
                    naaangkop na batas
                    kaugnay
                    ng iyong personal na datos. Ito ay kasama ang mga sumusunod:</p>
                  <ul>
                    <li>Karapatan sa Pag-access - ang karapatan na humiling ng pag-access sa iyong
                      personal na datos at
                      maabisuhan tungkol sa pagproseso ng iyong personal na datos;</li>
                    <li>Karapatan sa Pagbura - ang karapatan na humiling ng pagtanggal ng iyong
                      personal
                      na datos;
                    </li>
                    <li>Karapatan sa Pagpigil ng Paggamit - ang karapatan na humiling ng pagpigil sa
                      paggamit ng iyong
                      personal na datos;
                    </li>
                    <li>Karapatan sa Pagtutol - ang karapatan na tumutol sa pagproseso ng iyong
                      personal
                      na datos;</li>
                    <li>Karapatan sa Portabilidad ng Datos - ang karapatan na matanggap ang iyong
                      personal na datos sa
                      isang
                      makabuluhang, karaniwang ginagamit, at may kakayahang basahin ng makina na
                      format.</li>
                  </ul>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Paano namin Kinokolekta ang Iyong Personal na Datos</h3>
                <div>
                  <p>Kinokolekta namin ang iyong personal na datos sa mga sumusunod na paraan:</p>
                  <p> Ito ang mga sumusunod na mga datos na kinakailangan sa pagpaparehistro, kasama
                    ang
                    karampatang
                    layunin
                    nito:</p>
                  <ul>
                    <li>Buong Pangalan – upang wastong kilalanin ang tamang tao sa pagpaparehistro.
                    </li>
                    <li>Suffix – upang malaman kung may salaysay ang pangalan ng isang tao.</li>
                    <li>Kasarian – upang uriin ang isang tao batay sa kanilang kasarian noong sila
                      ay
                      ipinanganak.</li>
                    <li>Katayuan Sibil – upang ilarawan ang relasyon ng isang tao sa kanilang
                      kasintahan
                      o kasama sa
                      buhay
                    </li>
                    <li>Nasyonalidad – legal na pagkakakilanlan ng isang tao sa batas
                      pang-internasyonal
                      na iba sa
                      pagkamamamayan.
                    </li>
                    <li>Petsa ng Kapanganakan – ginagamit para sa tamang pagkilala at sa mga
                      pagkakataong maraming tao
                      ang
                      may parehong pangalan.</li>
                    <li>Edad – upang malaman ang edad ng isang tao.</li>
                    <li>Lugar ng Kapanganakan – upang malaman kung saan isinilang ang tao.</li>
                    <li>Tirahan – upang matukoy ng mga awtoridad ang eksaktong lokasyon ng isang
                      tao.
                    </li>
                    <li> Valid ID – upang tiyakin ang lahat ng impormasyon na ibinigay ng gumagamit.
                    </li>
                    <li>ID Number – upang tiyakin na walang dalawang tao sa loob ng sistema ang may
                      parehong numero.
                    </li>
                    <li>Email – para sa sistema na magkaroon ng opsiyon na iba't-ibang paraan ng
                      pagkakakilanlan bukod
                      sa
                      numero ng mobile.</li>
                    <li>Mobile Number – ginagamit para sa pambihirang pagkakakilanlan sa sistema at
                      upang makontak ang
                      user
                      kung kinakailangan ng mga opisyal ng barangay</li>
                  </ul>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Para sa Anong Layunin Namin Ginagamit ang Iyong Personal na
                  Datos?
                </h3>
                <div>
                  <p>Ginagamit namin ang iyong personal na datos upang magbigay at mapabuti ang aming
                    mga
                    serbisyo sa
                    iyo.
                    Ito ay kasama ang mga sumusunod:</p>
                  <ul>
                    <li>Upang makipag-ugnayan sa iyo tungkol sa aming mga serbisyo at magbigay ng
                      suporta sa mga
                      customer.
                    </li>
                    <li>Upang ma-proseso ang mga transaksyon sa aming mga serbisyo..</li>
                    <li>Upang mapabuti ang aming mga serbisyo at gumawa ng mga bagong feature.</li>
                    <li>Upang sumunod sa mga legal na obligasyon.</li>
                  </ul>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Pagbabahagi ng Iyong Personal na Datos</h3>
                <div>
                  <p>Hindi namin ibinebenta, inuupa, o inirerentahan ang iyong personal na impormasyon
                    sa
                    mga third
                    parties
                    nang walang iyong pahintulot. Maaring ibahagi namin ang iyong personal na datos
                    sa
                    mga
                    third-party service provider na tumutulong sa amin sa pagpapatakbo ng aming web
                    app
                    o nagbibigay ng
                    serbisyo sa iyo. Kinakailangang panatilihing konpidensyal at ligtas ng mga
                    service
                    provider na ito
                    ang
                    iyong personal na datos. </p>
                  <p>Maari rin naming ilantad ang iyong personal na datos kung kinakailangan ng batas,
                    court order, o
                    iba
                    pang legal na proseso, o kung kami ay may matino at marerespetadong paniniwala
                    na
                    ang ganitong
                    paglantad
                    ay kinakailangan upang protektahan ang aming mga karapatan o ari-arian o ang
                    kaligtasan ng iba. </p>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Pag-iingat at Pagtanggal ng Datos </h3>
                <div>
                  <p>Ipinag-iingat namin ang iyong personal na datos hangga't kinakailangan lamang
                    upang
                    maipagkaloob
                    ang
                    aming mga serbisyo at para sa mga lehitimo at mahahalagang layunin ng negosyo,
                    tulad
                    ng pagsunod sa
                    mga
                    legal na obligasyon at pagresolba ng mga alituntunin. Secured naming tatanggalin
                    o
                    ipapa-anonimisa
                    ang
                    iyong personal na datos kapag hindi na ito kinakailangan para sa mga layuning
                    ito.
                  </p>
                </div>
                <hr style="background-color: white;">
                <h3 class="groupBoxHeader">Paagpapanatili ng Kaligtasan ng Inyong Datos </h3>
                <div>
                  <p>Kami ay gumagamit ng angkop na mga teknikal at organisasyonal na hakbang upang
                    protektahan ang
                    inyong
                    personal na datos laban sa hindi awtorisadong o labag sa batas na pagproseso,
                    aksidental na
                    pagkawala,
                    pagkasira, o pinsala. Kami rin ay nagpapatupad ng mga kontrol sa pag-access,
                    pag-e-encrypt, at mga
                    patakaran sa retensyon upang protektahan ang inyong personal na datos </p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="registration_id" class="btn" style="background-color: #AA0F0A; color:white">Accept</a>

          </div>
        </div>
      </div>
    </div>

  </header>
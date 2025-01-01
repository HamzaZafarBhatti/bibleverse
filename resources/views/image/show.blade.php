<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <style>
        * {
            padding: 0px;
            margin: 0 auto;
            box-sizing: border-box;
        }

        body {
            font-family: Helvetica;
        }

        @media screen and (min-width: 1100px) {

            h4,
            p {
                line-height: 86px;
                font-size: 50px !important;
            }

            .footer_mobile img {
                width: 80px;
                height: 80px;
            }
        }

        #content {
            background-size: cover;
            height: 100vh;
            background-repeat: no-repeat;
            color: white;
            align-items: center;
            display: flex;
            background-position: top center;
        }

        footer {
            display: block;
            position: fixed;
            bottom: 5%;
            text-align: center;
            width: 100%;
        }

        .footer_mobile li {
            list-style-type: none;
        }

        .footer_mobile {
            text-align: center;
            display: flex;
            flex-wrap: wrap;
        }

        .footer_mobile li>ul {
            background: #fff;
            transition: all 0.4s ease;
            overflow: hidden;
            position: absolute;
            bottom: 30px;
            width: 120px;
            right: 13%;
            left: auto;
            border-radius: 2px;
            max-height: 0px;
        }

        .footer_mobile li>ul>li span {
            color: #000;
            text-decoration: none;
            padding: 5px;
            display: block;
        }

        .footer_mobile li>ul>li+li {
            border-top: 1px solid #eee;
        }

        .footer_mobile li>ul.active {
            max-height: 100px;
        }

        .footer_mobile #languages_list li.active {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <input type="hidden" id="englishImage" value="{{ asset('storage/' . $cachedEnglishImage->image) }}">
    <input type="hidden" id="spanishImage" value="{{ asset('storage/' . $cachedSpanishImage->image) }}">
    <section id="content">
        <footer>
            <div class="footer_mobile">
                <li>
                    <a target="_blank" href="{{ $redirectUrl }}">
                        <img src="{{ asset('icons/cart.png') }}" width="27px">
                    </a>
                </li>
                <li>
                    <a>
                        <img src="{{ asset('storage/' . $icon) }}" width="35px">
                    </a>
                </li>
                <li>
                    <ul class="" id="languages_list">
                        <li class="active">
                            <span style="cursor: pointer" id="english" onclick="changeLanguage('english')">
                                English
                            </span>
                        </li>
                        <li class="">
                            <span style="cursor: pointer" id="spanish" onclick="changeLanguage('spanish')">
                                Spanish
                            </span>
                        </li>
                    </ul>
                    <a style="cursor: pointer" href="javascript:void(0);" onclick="showList();">
                        <img src="{{ asset('icons/more.png') }}" width="27px">
                    </a>
                </li>
            </div>
        </footer>
    </section>

    <script>
        const setActiveLanguage = (lang) => {
            localStorage.setItem('lang', lang);

            const englishElement = document.getElementById('english').parentNode;
            const spanishElement = document.getElementById('spanish').parentNode;

            const isEnglishActive = lang === 'english';

            englishElement.classList.toggle('active', isEnglishActive);
            spanishElement.classList.toggle('active', !isEnglishActive);
        };

        const getImage = (lang) => {
            // Check if the images are already stored
            if (lang === 'english') {
                return document.getElementById('englishImage').value;
            } else {
                return document.getElementById('spanishImage').value;
            }
        };

        const changeLanguage = (language) => {
            setActiveLanguage(language);

            let imageSection = document.getElementById('content');

            imageSection.style.backgroundImage = `url(${getImage(language)})`;

            if (document.getElementById("languages_list").classList.contains('active')) {
                showList();
            }
        };

        window.onload = function() {
            let lang = localStorage.getItem('lang') || 'english';
            changeLanguage(lang);
        }

        function showList() {
            document.getElementById("languages_list").classList.toggle("active");
        }
    </script>
</body>

</html>

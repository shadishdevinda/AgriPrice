<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AgriPrice</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Covered+By+Your+Grace&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
            *,
            ::after,
            ::before {
                box-sizing: border-box;
                border-width: 0;
                border-style: solid;
                border-color: #e5e7eb
            }

            ::after,
            ::before {
                --tw-content: ''
            }

            :host,
            html {
                line-height: 1.5;
                -webkit-text-size-adjust: 100%;
                -moz-tab-size: 4;
                tab-size: 4;
                font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
                font-feature-settings: normal;
                font-variation-settings: normal;
                -webkit-tap-highlight-color: transparent
            }

            body {
                margin: 0;
                line-height: inherit
            }

            hr {
                height: 0;
                color: inherit;
                border-top-width: 1px
            }

            abbr:where([title]) {
                -webkit-text-decoration: underline dotted;
                text-decoration: underline dotted
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-size: inherit;
                font-weight: inherit
            }

            a {
                color: inherit;
                text-decoration: inherit
            }

            b,
            strong {
                font-weight: bolder
            }

            code,
            kbd,
            pre,
            samp {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                font-feature-settings: normal;
                font-variation-settings: normal;
                font-size: 1em
            }

            small {
                font-size: 80%
            }

            sub,
            sup {
                font-size: 75%;
                line-height: 0;
                position: relative;
                vertical-align: baseline
            }

            sub {
                bottom: -.25em
            }

            sup {
                top: -.5em
            }

            table {
                text-indent: 0;
                border-color: inherit;
                border-collapse: collapse
            }

            button,
            input,
            optgroup,
            select,
            textarea {
                font-family: inherit;
                font-feature-settings: inherit;
                font-variation-settings: inherit;
                font-size: 100%;
                font-weight: inherit;
                line-height: inherit;
                color: inherit;
                margin: 0;
                padding: 0
            }

            button,
            select {
                text-transform: none
            }

            [type=button],
            [type=reset],
            [type=submit],
            button {
                -webkit-appearance: button;
                background-color: transparent;
                background-image: none
            }

            :-moz-focusring {
                outline: auto
            }

            :-moz-ui-invalid {
                box-shadow: none
            }

            progress {
                vertical-align: baseline
            }

            ::-webkit-inner-spin-button,
            ::-webkit-outer-spin-button {
                height: auto
            }

            [type=search] {
                -webkit-appearance: textfield;
                outline-offset: -2px
            }

            ::-webkit-search-decoration {
                -webkit-appearance: none
            }

            ::-webkit-file-upload-button {
                -webkit-appearance: button;
                font: inherit
            }

            summary {
                display: list-item
            }

            blockquote,
            dd,
            dl,
            figure,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            hr,
            p,
            pre {
                margin: 0
            }

            fieldset {
                margin: 0;
                padding: 0
            }

            legend {
                padding: 0
            }

            menu,
            ol,
            ul {
                list-style: none;
                margin: 0;
                padding: 0
            }

            dialog {
                padding: 0
            }

            textarea {
                resize: vertical
            }

            input::placeholder,
            textarea::placeholder {
                opacity: 1;
                color: #9ca3af
            }

            [role=button],
            button {
                cursor: pointer
            }

            :disabled {
                cursor: default
            }

            audio,
            canvas,
            embed,
            iframe,
            img,
            object,
            svg,
            video {
                display: block;
                vertical-align: middle
            }

            img,
            video {
                max-width: 100%;
                height: auto
            }

            [hidden] {
                display: none
            }

            *,
            ::before,
            ::after {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-gradient-from-position: ;
                --tw-gradient-via-position: ;
                --tw-gradient-to-position: ;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / 0.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia:
            }

            ::backdrop {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-gradient-from-position: ;
                --tw-gradient-via-position: ;
                --tw-gradient-to-position: ;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / 0.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia:
            }

            .absolute {
                position: absolute
            }

            .relative {
                position: relative
            }

            .-left-20 {
                left: -5rem
            }

            .top-0 {
                top: 0px
            }

            .-bottom-16 {
                bottom: -4rem
            }

            .-left-16 {
                left: -4rem
            }

            .-mx-3 {
                margin-left: -0.75rem;
                margin-right: -0.75rem
            }

            .mt-4 {
                margin-top: 1rem
            }

            .mt-6 {
                margin-top: 1.5rem
            }

            .flex {
                display: flex
            }

            .grid {
                display: grid
            }

            .hidden {
                display: none
            }

            .aspect-video {
                aspect-ratio: 16 / 9
            }

            .size-12 {
                width: 3rem;
                height: 3rem
            }

            .size-5 {
                width: 1.25rem;
                height: 1.25rem
            }

            .size-6 {
                width: 1.5rem;
                height: 1.5rem
            }

            .h-12 {
                height: 3rem
            }

            .h-40 {
                height: 10rem
            }

            .h-full {
                height: 100%
            }

            .min-h-screen {
                min-height: 100vh
            }

            .w-full {
                width: 100%
            }

            .w-\[calc\(100\%\+8rem\)\] {
                width: calc(100% + 8rem)
            }

            .w-auto {
                width: auto
            }

            .max-w-\[877px\] {
                max-width: 877px
            }

            .max-w-2xl {
                max-width: 42rem
            }

            .flex-1 {
                flex: 1 1 0%
            }

            .shrink-0 {
                flex-shrink: 0
            }

            .grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .flex-col {
                flex-direction: column
            }

            .items-start {
                align-items: flex-start
            }

            .items-center {
                align-items: center
            }

            .items-stretch {
                align-items: stretch
            }

            .justify-end {
                justify-content: flex-end
            }

            .justify-center {
                justify-content: center
            }

            .gap-2 {
                gap: 0.5rem
            }

            .gap-4 {
                gap: 1rem
            }

            .gap-6 {
                gap: 1.5rem
            }

            .self-center {
                align-self: center
            }

            .overflow-hidden {
                overflow: hidden
            }

            .rounded-\[10px\] {
                border-radius: 10px
            }

            .rounded-full {
                border-radius: 9999px
            }

            .rounded-lg {
                border-radius: 0.5rem
            }

            .rounded-md {
                border-radius: 0.375rem
            }

            .rounded-sm {
                border-radius: 0.125rem
            }

            .bg-\[\#FF2D20\]\/10 {
                background-color: rgb(255 45 32 / 0.1)
            }

            .bg-white {
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255 / var(--tw-bg-opacity))
            }

            .bg-gradient-to-b {
                background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
            }

            .from-transparent {
                --tw-gradient-from: transparent var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
            }

            .via-white {
                --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)
            }

            .to-white {
                --tw-gradient-to: #fff var(--tw-gradient-to-position)
            }

            .stroke-\[\#FF2D20\] {
                stroke: #FF2D20
            }

            .object-cover {
                object-fit: cover
            }

            .object-top {
                object-position: top
            }

            .p-6 {
                padding: 1.5rem
            }

            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .py-10 {
                padding-top: 2.5rem;
                padding-bottom: 2.5rem
            }

            .px-3 {
                padding-left: 0.75rem;
                padding-right: 0.75rem
            }

            .py-16 {
                padding-top: 4rem;
                padding-bottom: 4rem
            }

            .py-2 {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem
            }

            .pt-3 {
                padding-top: 0.75rem
            }

            .text-center {
                text-align: center
            }

            .font-sans {
                font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji
            }

            .text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem
            }

            .text-sm\/relaxed {
                font-size: 0.875rem;
                line-height: 1.625
            }

            .text-xl {
                font-size: 1.25rem;
                line-height: 1.75rem
            }

            .font-semibold {
                font-weight: 600
            }

            .text-black {
                --tw-text-opacity: 1;
                color: rgb(0 0 0 / var(--tw-text-opacity))
            }

            .text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .underline {
                -webkit-text-decoration-line: underline;
                text-decoration-line: underline
            }

            .antialiased {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale
            }

            .shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\] {
                --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, 0.08);
                --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .ring-transparent {
                --tw-ring-color: transparent
            }

            .ring-white\/\[0\.05\] {
                --tw-ring-color: rgb(255 255 255 / 0.05)
            }

            .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\] {
                --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.06));
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
            }

            .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\] {
                --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.25));
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
            }

            .transition {
                transition-property: color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms
            }

            .duration-300 {
                transition-duration: 300ms
            }

            .selection\:bg-\[\#FF2D20\] *::selection {
                --tw-bg-opacity: 1;
                background-color: rgb(255 45 32 / var(--tw-bg-opacity))
            }

            .selection\:text-white *::selection {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .selection\:bg-\[\#FF2D20\]::selection {
                --tw-bg-opacity: 1;
                background-color: rgb(255 45 32 / var(--tw-bg-opacity))
            }

            .selection\:text-white::selection {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .hover\:text-black:hover {
                --tw-text-opacity: 1;
                color: rgb(0 0 0 / var(--tw-text-opacity))
            }

            .hover\:text-black\/70:hover {
                color: rgb(0 0 0 / 0.7)
            }

            .hover\:ring-black\/20:hover {
                --tw-ring-color: rgb(0 0 0 / 0.2)
            }

            .focus\:outline-none:focus {
                outline: 2px solid transparent;
                outline-offset: 2px
            }

            .focus-visible\:ring-1:focus-visible {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity))
            }

            @media (min-width: 640px) {
                .sm\:size-16 {
                    width: 4rem;
                    height: 4rem
                }

                .sm\:size-6 {
                    width: 1.5rem;
                    height: 1.5rem
                }

                .sm\:pt-5 {
                    padding-top: 1.25rem
                }
            }

            @media (min-width: 768px) {
                .md\:row-span-3 {
                    grid-row: span 3 / span 3
                }
            }

            @media (min-width: 1024px) {
                .lg\:col-start-2 {
                    grid-column-start: 2
                }

                .lg\:h-16 {
                    height: 4rem
                }

                .lg\:max-w-7xl {
                    max-width: 80rem
                }

                .lg\:grid-cols-3 {
                    grid-template-columns: repeat(3, minmax(0, 1fr))
                }

                .lg\:grid-cols-2 {
                    grid-template-columns: repeat(2, minmax(0, 1fr))
                }

                .lg\:flex-col {
                    flex-direction: column
                }

                .lg\:items-end {
                    align-items: flex-end
                }

                .lg\:justify-center {
                    justify-content: center
                }

                .lg\:gap-8 {
                    gap: 2rem
                }

                .lg\:p-10 {
                    padding: 2.5rem
                }

                .lg\:pb-10 {
                    padding-bottom: 2.5rem
                }

                .lg\:pt-0 {
                    padding-top: 0px
                }

                .lg\:text-\[\#FF2D20\] {
                    --tw-text-opacity: 1;
                    color: rgb(255 45 32 / var(--tw-text-opacity))
                }
            }

            @media (prefers-color-scheme: dark) {
                .dark\:block {
                    display: block
                }

                .dark\:hidden {
                    display: none
                }

                .dark\:bg-black {
                    --tw-bg-opacity: 1;
                    background-color: rgb(0 0 0 / var(--tw-bg-opacity))
                }

                .dark\:bg-zinc-900 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(24 24 27 / var(--tw-bg-opacity))
                }

                .dark\:via-zinc-900 {
                    --tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)
                }

                .dark\:to-zinc-900 {
                    --tw-gradient-to: #18181b var(--tw-gradient-to-position)
                }

                .dark\:text-white\/50 {
                    color: rgb(255 255 255 / 0.5)
                }

                .dark\:text-white {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity))
                }

                .dark\:text-white\/70 {
                    color: rgb(255 255 255 / 0.7)
                }

                .dark\:ring-zinc-800 {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity))
                }

                .dark\:hover\:text-white:hover {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity))
                }

                .dark\:hover\:text-white\/70:hover {
                    color: rgb(255 255 255 / 0.7)
                }

                .dark\:hover\:text-white\/80:hover {
                    color: rgb(255 255 255 / 0.8)
                }

                .dark\:hover\:ring-zinc-700:hover {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity))
                }

                .dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity))
                }

                .dark\:focus-visible\:ring-white:focus-visible {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity))
                }
            }
        </style>
    @endif
</head>

<style>
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }
</style>

<body class="font-sans antialiased">

    {{-- Page 1st bar --}}
    <div class="top bg-light">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm text-md-left mb-md-0 mt-2 pr-md-4 d-flex topper align-items-center">
                    <p class="mb-0 w-100 pl-2 pl-md-0">
                        <span class="fa fa-paper-plane"></span>
                        <span class="text">agriprice@gamil.com</span>
                    </p>
                </div>
                <div class="col-sm d-flex mb-md-0 mb-2">
                    <div class="social-media">
                        <p class="mb-0 d-flex">
                            <a href="https://www.facebook.com/" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="https://x.com/" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a href="https://www.instagram.com/" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Page 2nd bar --}}
    <div class="pt-4 pb-5">
        <div class="container">
            <div class="row d-flex align-items-start align-items-center px-3 px-md-0">
                <div class="col-md-4 d-flex mb-2 mb-md-0">
                    <a class="navbar-brand d-flex align-items-center" href="index.html">
                        <span class="flaticon flaticon-agriculture"></span>
                        <span class="ml-2">AgriPrice <small>Agriculture Farming</small></span>
                    </a>
                </div>
                <div class="col-md-4 d-flex topper mb-md-0 mb-2 align-items-center">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="fa fa-map"></span>
                    </div>
                    <div class="pr-md-4 pl-md-3 pl-3 text">
                        <p class="con"><span>Free Call</span> <span>+94 7 748 602 17</span></p>
                        <p class="con">Call Us Now 24/7 Customer Support</p>
                    </div>
                </div>
                <div class="col-md-4 d-flex topper mb-md-0 align-items-center">
                    <div class="icon d-flex justify-content-center align-items-center"><span
                            class="fa fa-paper-plane"></span>
                    </div>
                    <div class="text pl-3 pl-md-3">
                        <p class="hr"><span>Our Location</span></p>
                        <p class="con">33/A Colombo Road.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                  </svg></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <!-- Home with Dropdown -->
                    <li class="nav-item dropdown">
                        <a href="index.html" class="nav-link dropdown-toggle" id="homeDropdown" role="button">
                            Home
                        </a>
                            <ul class="dropdown-menu" aria-labelledby="homeDropdown">
                                <li><a class="dropdown-item" href="about.html">About</a></li>
                                <li><a class="dropdown-item" href="services.html">Services</a></li>
                                <li><a class="dropdown-item" href="project.html">Projects</a></li>
                                <li><a class="dropdown-item" href="blog.html">Blog</a></li>
                                <li><a class="dropdown-item" href="contact.html">Contact</a></li>
                            </ul>

                        <li><a class="nav-link" href="vegetables-prices.html">Vegetables Prices</a></li>
                        <li><a class="nav-link" href="fruits-prices.html">Fruits Prices</a></li>
                        <li><a class="nav-link" href="crops-advices.html">Crops Advices</a></li>

                    </li>
                </ul>

                <!-- Authentication Links -->
                @if (Route::has('login'))
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Welcome, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                            </li>
                        @endauth
                    </ul>
                @endif
            </div>

        </div>
    </nav>

    <section class="hero-wrap js-fullheight">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-8 text-center ftco-animate">
                    <div class="mb-5">
                        <span class="subheading">Welcome to Famrland</span>
                        <h1 class="mb-4">Agriculture is the Most Healthful</h1>
                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and
                            Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
                        <p><a href="#" class="btn btn-primary">Our Services</a> <a href="#"
                                class="btn btn-secondary">Request A Quote</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-slider owl-carousel js-fullheight">
            <div class="slider-item js-fullheight" style="background-image:url('/images/bg_1.jpg');"
                data-stellar-background-ratio="0.5">
            </div>
            <div class="slider-item js-fullheight" style="background-image:url('/images/bg_2.jpg');"
                data-stellar-background-ratio="0.5">
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-services ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="services">
                        <div class="p-4">
                            <div class="media-body">
                                <h3 class="heading mb-3">Fresh <br>Vegetables</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country, in which roasted parts</p>
                            </div>
                        </div>
                        <div class="img" style="background-image: url(images/services-1.jpg);">
                            <a href="#"
                                class="btn-custom d-flex align-items-center justify-content-center"><span
                                    class="fa fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="services">
                        <div class="p-4">
                            <div class="media-body">
                                <h3 class="heading mb-3">Agricultural <br>Products</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country, in which roasted parts</p>
                            </div>
                        </div>
                        <div class="img" style="background-image: url(images/services-2.jpg);">
                            <a href="#"
                                class="btn-custom d-flex align-items-center justify-content-center"><span
                                    class="fa fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="services">
                        <div class="p-4">
                            <div class="media-body">
                                <h3 class="heading mb-3">Organic <br>Products</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country, in which roasted parts</p>
                            </div>
                        </div>
                        <div class="img" style="background-image: url(images/services-3.jpg);">
                            <a href="#"
                                class="btn-custom d-flex align-items-center justify-content-center"><span
                                    class="fa fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="services">
                        <div class="p-4">
                            <div class="media-body">
                                <h3 class="heading mb-3">Dairy <br>Products</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country, in which roasted parts</p>
                            </div>
                        </div>
                        <div class="img" style="background-image: url(images/services-4.jpg);">
                            <a href="#"
                                class="btn-custom d-flex align-items-center justify-content-center"><span
                                    class="fa fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb ftco-about img">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-12 about-intro">
                    <div class="row d-flex">
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="img d-flex align-items-center align-self-stretch justify-content-center"
                                style="background-image:url(images/about-1.jpg);">
                                <div class="year-stablish text-center">
                                    <div class="icon2"><span class="flaticon-calendar"></span></div>
                                    <div class="text">
                                        <strong class="number" data-number="42">0</strong>
                                        <span>Year Of<br> Experienced</span>
                                    </div>
                                </div>
                                <div class="img-2 d-flex align-items-center justify-content-center"
                                    style="background-image:url(images/about-2.jpg);">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-5 py-5">
                            <div class="row justify-content-start pb-3">
                                <div class="col-md-12 heading-section ftco-animate">
                                    <span class="subheading">About Farmland</span>
                                    <h2 class="mb-4">We're Leader In Agricultural Market</h2>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                        Consonantia, there live the blind texts. Separated they live in Bookmarksgrove
                                        right at the coast of the Semantics, a large language ocean. A small river named
                                        Duden flows by their place and supplies it with the necessary regelialia.</p>
                                    <div class="row my-4">
                                        <div class="col-md-6 ftco-animate">
                                            <div class="services-2 d-flex align-items-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="flaticon-agriculture"></span>
                                                </div>
                                                <div class="media-body">
                                                    <h3 class="heading">Growing Fruits<br> and Vegetables</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ftco-animate">
                                            <div class="services-2 d-flex align-items-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="flaticon-agriculture-2"></span>
                                                </div>
                                                <div class="media-body">
                                                    <h3 class="heading">Tips for Ripening<br> Fruits</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p><a href="#" class="btn btn-secondary">Learn More</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-counter img" id="section-counter"
        style="background-image: url(images/bg_2.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex counter-wrap ftco-animate">
                    <div class="block-18 mb-xl-0 mb-2 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-agriculture-1"></span></div>
                        <div class="text pl-3">
                            <strong class="number" data-number="4800">0</strong>
                            <span>Project Completed</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex counter-wrap ftco-animate">
                    <div class="block-18 mb-xl-0 mb-2 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-agriculture"></span></div>
                        <div class="text pl-3">
                            <strong class="number" data-number="14000">0</strong>
                            <span>Total Products</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex counter-wrap ftco-animate">
                    <div class="block-18 mb-xl-0 mb-2 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-agriculture-2"></span></div>
                        <div class="text pl-3">
                            <strong class="number" data-number="200">0</strong>
                            <span>Services Provide</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex counter-wrap ftco-animate">
                    <div class="block-18 mb-xl-0 mb-2 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-approve"></span></div>
                        <div class="text pl-3">
                            <strong class="number" data-number="71650">0</strong>
                            <span>Satisfied Customers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Recent Work</span>
                    <h2 class="mb-4">Explore Projects</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid px-md-4">
            <div class="row">
                <div class="col-md-3 ftco-animate">
                    <div class="project-wrap img d-flex align-items-end"
                        style="background-image: url(images/work-1.jpg);">
                        <div class="text">
                            <h3><a href="portfolio-single.html">Organic Solution</a></h3>
                            <a href="portfolio-single.html"
                                class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ftco-animate">
                    <div class="project-wrap img d-flex align-items-end"
                        style="background-image: url(images/work-2.jpg);">
                        <div class="text">
                            <h3><a href="portfolio-single.html">Harvest Innovation</a></h3>
                            <a href="portfolio-single.html"
                                class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ftco-animate">
                    <div class="project-wrap img d-flex align-items-end"
                        style="background-image: url(images/work-3.jpg);">
                        <div class="text">
                            <h3><a href="portfolio-single.html">Farm System</a></h3>
                            <a href="portfolio-single.html"
                                class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ftco-animate">
                    <div class="project-wrap img d-flex align-items-end"
                        style="background-image: url(images/work-4.jpg);">
                        <div class="text">
                            <h3><a href="portfolio-single.html">Agricultural Farming</a></h3>
                            <a href="portfolio-single.html"
                                class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video-image img" style="background-image: url(images/bg_3.jpg);">
        <div class="overlay-2"></div>
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center wrap-video">
                <div class="col-md-6 text-center">
                    <a href="https://vimeo.com/45830194"
                        class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
                        <span class="fa fa-play"></span>
                    </a>
                    <h3>Watch Modern Agricultural Farming</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt testimony-section">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 heading-section pr-md-5 pt-5 mt-md-5 mb-5 mb-md-0">
                    <span class="subheading">Testimonial</span>
                    <h2 class="mb-4">What Are Cutomers Says About</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It
                        is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    <div class="block-18 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-agriculture"></span></div>
                        <div class="text pl-3">
                            <strong class="number" data-number="30587">0</strong>
                            <span>Total Products</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-md-5 d-flex align-items-stretch">
                    <div class="carousel-testimony owl-carousel d-flex align-items-center">
                        <div class="item">
                            <div class="testimony-wrap">
                                <div class="text">
                                    <span class="fa">"</span>
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts. A small river named Duden
                                        flows by their place and supplies it with the necessary regelialia. It is a
                                        paradisematic country, in which roasted parts of sentences fly into your mouth.
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_1.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap">
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts. A small river named Duden
                                        flows by their place and supplies it with the necessary regelialia. It is a
                                        paradisematic country, in which roasted parts of sentences fly into your mouth.
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_2.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap">
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts. A small river named Duden
                                        flows by their place and supplies it with the necessary regelialia. It is a
                                        paradisematic country, in which roasted parts of sentences fly into your mouth.
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_3.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap">
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts. A small river named Duden
                                        flows by their place and supplies it with the necessary regelialia. It is a
                                        paradisematic country, in which roasted parts of sentences fly into your mouth.
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_1.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap">
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts. A small river named Duden
                                        flows by their place and supplies it with the necessary regelialia. It is a
                                        paradisematic country, in which roasted parts of sentences fly into your mouth.
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_2.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr style="margin: 0;">

    <section class="ftco-section ftco-faqs services-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-6 mb-5 md-md-0 heading-section">
                    <span class="subheading">Request Quote</span>
                    <h2 class="mb-5">Request An Estimate</h2>
                    <form action="#" class="appointment-form ftco-animate">
                        <div class="">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Phone">
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <div class="form-field">
                                    <div class="select-wrap">
                                        <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                        <select name="" id="" class="form-control">
                                            <option value="">Select Your Services</option>
                                            <option value="">Organic Solution</option>
                                            <option value="">Harvest Innovation</option>
                                            <option value="">Farm System</option>
                                            <option value="">Agriculture Farming</option>
                                            <option value="">Other Services</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Request A Quote" class="btn btn-primary py-3 px-4">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 heading-section pl-lg-5 ftco-animate">
                    <div class="w-100 mb-4 mb-md-0">
                        <span class="subheading">Freequesntly Ask Question</span>
                        <h2 class="mb-5">Frequently Ask Question</h2>
                        <div id="accordion" class="myaccordion w-100" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-header p-0" id="headingOne">
                                    <h2 class="mb-0">
                                        <button href="#collapseOne"
                                            class="d-flex align-items-center justify-content-between btn btn-link"
                                            data-parent="#accordion" data-toggle="collapse" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <p class="mb-0">How to Manage Your Farm?</p>
                                            <i class="fa" aria-hidden="true"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div class="collapse show" id="collapseOne" role="tabpanel"
                                    aria-labelledby="headingOne">
                                    <div class="card-body py-3 px-0">
                                        <ol>
                                            <li>Far far away, behind the word mountains</li>
                                            <li>Consonantia, there live the blind texts</li>
                                            <li>When she reached the first hills of the Italic Mountains</li>
                                            <li>Bookmarksgrove, the headline of Alphabet Village</li>
                                            <li>Separated they live in Bookmarksgrove right</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header p-0" id="headingTwo" role="tab">
                                    <h2 class="mb-0">
                                        <button href="#collapseTwo"
                                            class="d-flex align-items-center justify-content-between btn btn-link"
                                            data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            <p class="mb-0">How to Cultivate Soil?</p>
                                            <i class="fa" aria-hidden="true"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div class="collapse" id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="card-body py-3 px-0">
                                        <ol>
                                            <li>Far far away, behind the word mountains</li>
                                            <li>Consonantia, there live the blind texts</li>
                                            <li>When she reached the first hills of the Italic Mountains</li>
                                            <li>Bookmarksgrove, the headline of Alphabet Village</li>
                                            <li>Separated they live in Bookmarksgrove right</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header p-0" id="headingThree" role="tab">
                                    <h2 class="mb-0">
                                        <button href="#collapseThree"
                                            class="d-flex align-items-center justify-content-between btn btn-link"
                                            data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            <p class="mb-0">How To Ripe Fruits in A Better Way</p>
                                            <i class="fa" aria-hidden="true"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div class="collapse" id="collapseThree" role="tabpanel"
                                    aria-labelledby="headingTwo">
                                    <div class="card-body py-3 px-0">
                                        <ol>
                                            <li>Far far away, behind the word mountains</li>
                                            <li>Consonantia, there live the blind texts</li>
                                            <li>When she reached the first hills of the Italic Mountains</li>
                                            <li>Bookmarksgrove, the headline of Alphabet Village</li>
                                            <li>Separated they live in Bookmarksgrove right</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header p-0" id="headingFour" role="tab">
                                    <h2 class="mb-0">
                                        <button href="#collapseFour"
                                            class="d-flex align-items-center justify-content-between btn btn-link"
                                            data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            <p class="mb-0">What are those requirements for businesses?</p>
                                            <i class="fa" aria-hidden="true"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div class="collapse" id="collapseFour" role="tabpanel"
                                    aria-labelledby="headingTwo">
                                    <div class="card-body py-3 px-0">
                                        <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                            Consonantia, there live the blind texts. Separated they live in
                                            Bookmarksgrove right at the coast of the Semantics, a large language ocean.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Our Blog</span>
                    <h2 class="mb-4">Recent Post</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ftco-animate">
                    <div class="blog-entry">
                        <a href="blog-single.html" class="block-20"
                            style="background-image: url('images/image_1.jpg');">
                        </a>
                        <div class="text d-block text-center">
                            <div class="meta">
                                <p>
                                    <a href="#"><span class="fa fa-calendar mr-2"></span>Sept. 23, 2020</a>
                                    <a href="#"><span class="fa fa-user mr-2"></span>Admin</a>
                                    <a href="#" class="meta-chat"><span class="fa fa-comment mr-2"></span>
                                        3</a>
                                </p>
                            </div>
                            <h3 class="heading"><a href="#">Organic Products For Healthy Living</a></h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                Consonantia...</p>
                            <p class="mb-0"><a href="#" class="btn-custom">Read more</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 ftco-animate">
                    <div class="blog-entry">
                        <a href="blog-single.html" class="block-20"
                            style="background-image: url('images/image_2.jpg');">
                        </a>
                        <div class="text d-block text-center">
                            <div class="meta">
                                <p>
                                    <a href="#"><span class="fa fa-calendar mr-2"></span>Sept. 23, 2020</a>
                                    <a href="#"><span class="fa fa-user mr-2"></span>Admin</a>
                                    <a href="#" class="meta-chat"><span class="fa fa-comment mr-2"></span>
                                        3</a>
                                </p>
                            </div>
                            <h3 class="heading"><a href="#">Organic Products For Healthy Living</a></h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                Consonantia...</p>
                            <p class="mb-0"><a href="#" class="btn-custom">Read more</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="blog-entry">
                        <a href="blog-single.html" class="block-20"
                            style="background-image: url('images/image_3.jpg');">
                        </a>
                        <div class="text d-block text-center">
                            <div class="meta">
                                <p>
                                    <a href="#"><span class="fa fa-calendar mr-2"></span>Sept. 23, 2020</a>
                                    <a href="#"><span class="fa fa-user mr-2"></span>Admin</a>
                                    <a href="#" class="meta-chat"><span class="fa fa-comment mr-2"></span>
                                        3</a>
                                </p>
                            </div>
                            <h3 class="heading"><a href="#">Organic Products For Healthy Living</a></h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                Consonantia...</p>
                            <p class="mb-0"><a href="#" class="btn-custom">Read more</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-intro img" style="background-image: url(images/bg_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section heading-section-white text-center ftco-animate">
                    <p class="subheading">A small river named Duden flows by their place</p>
                    <h2>Subscribe to our Newsletter</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="#" class="subscribe-form ftco-animate">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control" placeholder="Enter email address">
                            <input type="submit" value="Subscribe" class="submit px-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer">
        <div class="container">
            <div class="row mb-5 justify-content-between">
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 logo"><a href="#">Farmland</a></h2>
                        <p>Far far away, behind the word mountains, far from the countries.</p>
                        <ul class="ftco-footer-social list-unstyled mt-2">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Explore</h2>
                        <div class="block-21 mb-4 d-flex">
                            <a class="img mr-4 rounded" style="background-image: url(images/image_1.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Organic Products For Healthy Living</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Oct. 06, 2020</a>
                                    </div>
                                    <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="img mr-4 rounded" style="background-image: url(images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Organic Products For Healthy Living</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Oct. 06, 2020</a>
                                    </div>
                                    <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Explore</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>About</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Contact</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Projects</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Services</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map marker"></span><span class="text">203 Fake St.
                                        Mountain View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2
                                            392 3929 210</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span
                                            class="text"><span class="__cf_email__"
                                                data-cfemail="d4bdbab2bb94adbba1a6b0bbb9b5bdbafab7bbb9">[email�&nbsp;protected]</span></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0 py-5 bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <p class="mb-0" style="color: rgba(255,255,255,.5);">Copyright ©
                            <script data-cfasync="false" src="js/email-decode.min.js"></script>
                            <script>
                                document.write(new Date().getFullYear());
                            </script>2024 All rights reserved | This template is made with <i
                                class="fa fa-heart color-danger" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank" rel="nofollow noopener">Colorlib</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee"></circle>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00"></circle>
        </svg>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&amp;sensor=false">
    </script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

    <script defer=""
        src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        data-cf-beacon="{"
        rayid":"8efc9380fe84671b","servertiming":{"name":{"cfextpri":true,"cfl4":true,"cfspeedbrain":true,"cfcachestatus":true}},"version":"2024.10.5","token":"cd0b4b3a733644fc843ef0b185f98241"}"=""
        crossorigin="anonymous"></script>

</body>

</html>

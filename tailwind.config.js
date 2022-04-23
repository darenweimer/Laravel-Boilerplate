const colors = require('tailwindcss/colors');

// const defaultTheme = require('tailwindcss/defaultTheme');
// const screens = Object.assign({}, defaultTheme.screens);
// delete screens['2xl'];

module.exports = {
    content: [
        './resources/**/*.{html,js,php,vue}',
    ],
    safelist: [
        {
            pattern: /(border|bg|text)-(|.+-)(default|primary|accent|info|success|error)/,
        },
    ],
    theme: {
        container: {
            center: true,
            // screens: screens,
        },
        extend: {
            borderColor: {
                'default': colors.gray['600'],
                'primary': colors.fuchsia['800'],
                'accent':  colors.amber['800'],
                'info':    colors.sky['700'],
                'success': colors.green['700'],
                'error':   colors.rose['800'],
            },
            backgroundColor: {
                'canvas':      colors.gray['900'],
                'default':     colors.gray['800'],
                'btn-default': colors.gray['600'],
                'btn-primary': colors.fuchsia['800'],
                'btn-accent':  colors.amber['800'],
                'btn-info':    colors.sky['700'],
                'btn-success': colors.green['800'],
                'btn-error':   colors.rose['800'],
            },
            fontFamily: {
                'default': ['Noto Sans Display'],
                'mono':    ['Inconsolata'],
            },
            fontWeight: {
                'thin':   250,
                'normal': 375,
                'medium': 550,
                'bold':   700,
                'black':  900,
            },
            textColor: {
                'default':     colors.gray['400'],
                'title':       colors.gray['300'],
                'primary':     colors.fuchsia['400'],
                'accent':      colors.amber['500'],
                'info':        colors.sky['400'],
                'success':     colors.green['500'],
                'error':       colors.rose['400'],
                'btn-default': colors.gray['100'],
                'btn-primary': colors.fuchsia['100'],
                'btn-accent':  colors.amber['100'],
                'btn-info':    colors.sky['100'],
                'btn-success': colors.green['100'],
                'btn-error':   colors.rose['100'],
            },
            textDecorationColor: {
                'link':       colors.amber['700'],
                'link-hover': colors.amber['600'],
            },
        },
    },
};

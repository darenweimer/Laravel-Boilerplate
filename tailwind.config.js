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
            pattern: /max-w-.+/,
        },
        {
            pattern: /m(t|b)-.+/,
        },
        {
            pattern: /border-(x|t|b)-.+/,
        },
        {
            pattern: /(border|bg|text)-(alert|btn|card)-.+/,
            variants: [
                'active',
                'disabled',
                'focus',
                'hover',
            ],
        },
        {
            pattern: /text-(left|center|right)/,
        },
        {
            pattern: /align-(top|middle|bottom)/,
        },
        {
            pattern: /origin-.+/,
        },
    ],
    theme: {
        container: {
            center: true,
            // screens: screens,
        },
        extend: {
            ringColor: {
                'input': colors.slate['200'],
            },
            borderColor: {
                'default':      colors.slate['400'],
                'card-default': colors.slate['700'],
                'card-primary': colors.fuchsia['900'],
                'card-info':    colors.sky['900'],
                'card-success': colors.green['900'],
                'card-error':   colors.red['900'],
            },
            backgroundColor: {
                'default':            colors.slate['900'],
                'primary':            colors.fuchsia['900'],
                'info':               colors.sky['900'],
                'success':            colors.green['900'],
                'error':              colors.red['900'],
                'alert-default':      colors.slate['300'],
                'alert-primary':      colors.fuchsia['300'],
                'alert-info':         colors.sky['300'],
                'alert-success':      colors.green['300'],
                'alert-error':        colors.red['300'],
                'btn-default':        colors.slate['500'],
                'btn-default-hover':  colors.slate['600'],
                'btn-default-active': colors.slate['700'],
                'btn-primary':        colors.fuchsia['700'],
                'btn-primary-hover':  colors.fuchsia['800'],
                'btn-primary-active': colors.fuchsia['900'],
                'btn-info':           colors.sky['700'],
                'btn-info-hover':     colors.sky['800'],
                'btn-info-active':    colors.sky['900'],
                'btn-success':        colors.green['700'],
                'btn-success-hover':  colors.green['800'],
                'btn-success-active': colors.green['900'],
                'btn-error':          colors.red['700'],
                'btn-error-hover':    colors.red['800'],
                'btn-error-active':   colors.red['900'],
                'card-default':       colors.slate['700'],
                'card-primary':       colors.fuchsia['900'],
                'card-info':          colors.sky['900'],
                'card-success':       colors.green['900'],
                'card-error':         colors.red['900'],
                'dropdown':           colors.slate['700'],
                'dropdown-highlight': colors.slate['600'],
                'input':              colors.sky['900'],
                'input-disabled':     colors.neutral['700'],
                'input-invalid':      colors.red['900'],
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
                'default':            colors.slate['400'],
                'title':              colors.slate['200'],
                'primary':            colors.fuchsia['400'],
                'info':               colors.sky['400'],
                'success':            colors.green['500'],
                'error':              colors.red['400'],
                'bg-primary':         colors.fuchsia['200'],
                'bg-info':            colors.sky['200'],
                'bg-success':         colors.green['200'],
                'bg-error':           colors.red['200'],
                'alert-default':      colors.slate['800'],
                'alert-primary':      colors.fuchsia['900'],
                'alert-info':         colors.sky['900'],
                'alert-success':      colors.green['900'],
                'alert-error':        colors.red['900'],
                'btn-default':        colors.slate['50'],
                'btn-primary':        colors.fuchsia['100'],
                'btn-info':           colors.sky['100'],
                'btn-success':        colors.green['100'],
                'btn-error':          colors.red['100'],
                'card-default':       colors.slate['200'],
                'card-primary':       colors.fuchsia['100'],
                'card-info':          colors.sky['100'],
                'card-success':       colors.green['100'],
                'card-error':         colors.red['100'],
                'dropdown':           colors.slate['300'],
                'dropdown-highlight': colors.slate['100'],
                'input':              colors.sky['100'],
                'input-disabled':     colors.neutral['400'],
                'input-invalid':      colors.red['100'],
            },
            textDecorationColor: {
                'link':       colors.orange['600'],
                'link-hover': colors.orange['400'],
            },
            placeholderColor: {
                'input':          colors.slate['400'],
                'input-disabled': colors.neutral['400'],
                'input-invalid':  colors.red['400'],
            },
        },
    },
};

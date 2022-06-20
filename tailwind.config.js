const colors = require('tailwindcss/colors');

// const defaultTheme = require('tailwindcss/defaultTheme');
// const screens = Object.assign({}, defaultTheme.screens);
// delete screens['2xl'];

module.exports = {
    content: [
        './resources/**/*.{css,html,js,php,vue}',
    ],
    safelist: [
        {
            pattern: /max-w-.+/,
        },
        {
            pattern: /(mt|mb)-.+/,
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
            borderColor: {
                light: {
                    'default':        colors.slate['600'],
                    'primary':        colors.fuchsia['800'],
                    'info':           colors.sky['700'],
                    'success':        colors.green['700'],
                    'warning':        colors.amber['800'],
                    'error':          colors.rose['800'],
                    'input':          colors.sky['800'],
                    'input-focused':  colors.sky['300'],
                    'input-success':  colors.green['500'],
                    'input-error':    colors.rose['400'],
                    'input-disabled': colors.zinc['600'],
                },
                dark: {
                    'default':        colors.slate['600'],
                    'primary':        colors.fuchsia['800'],
                    'info':           colors.sky['700'],
                    'success':        colors.green['700'],
                    'warning':        colors.amber['800'],
                    'error':          colors.rose['800'],
                    'input':          colors.sky['800'],
                    'input-focused':  colors.sky['300'],
                    'input-success':  colors.green['500'],
                    'input-error':    colors.rose['400'],
                    'input-disabled': colors.zinc['600'],
                },
            },
            backgroundColor: {
                light: {
                    'canvas':         colors.slate['900'],
                    'default':        colors.slate['800'],
                    'btn-default':    colors.slate['600'],
                    'btn-primary':    colors.fuchsia['800'],
                    'btn-info':       colors.sky['700'],
                    'btn-success':    colors.green['800'],
                    'btn-warning':    colors.amber['800'],
                    'btn-error':      colors.rose['800'],
                    'alert-default':  colors.slate['300'],
                    'alert-primary':  colors.fuchsia['300'],
                    'alert-info':     colors.sky['300'],
                    'alert-success':  colors.green['300'],
                    'alert-warning':  colors.amber['300'],
                    'alert-error':    colors.rose['300'],
                    'dropdown':       colors.gray['300'],
                    'dropdown-hover': colors.gray['200'],
                    'input-disabled': colors.zinc['800'],
                },
                dark: {
                    'canvas':         colors.slate['900'],
                    'default':        colors.slate['800'],
                    'btn-default':    colors.slate['600'],
                    'btn-primary':    colors.fuchsia['800'],
                    'btn-info':       colors.sky['700'],
                    'btn-success':    colors.green['800'],
                    'btn-warning':    colors.amber['800'],
                    'btn-error':      colors.rose['800'],
                    'alert-default':  colors.slate['300'],
                    'alert-primary':  colors.fuchsia['300'],
                    'alert-info':     colors.sky['300'],
                    'alert-success':  colors.green['300'],
                    'alert-warning':  colors.amber['300'],
                    'alert-error':    colors.rose['300'],
                    'dropdown':       colors.gray['300'],
                    'dropdown-hover': colors.gray['200'],
                    'input-disabled': colors.zinc['800'],
                },
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
                light: {
                    'default':              colors.slate['400'],
                    'title':                colors.slate['300'],
                    'primary':              colors.fuchsia['400'],
                    'info':                 colors.sky['400'],
                    'success':              colors.green['500'],
                    'warning':              colors.amber['500'],
                    'error':                colors.rose['400'],
                    'btn-default':          colors.slate['100'],
                    'btn-primary':          colors.fuchsia['100'],
                    'btn-info':             colors.sky['100'],
                    'btn-success':          colors.green['100'],
                    'btn-warning':          colors.amber['100'],
                    'btn-error':            colors.rose['100'],
                    'alert-default':        colors.slate['900'],
                    'alert-primary':        colors.fuchsia['900'],
                    'alert-info':           colors.sky['900'],
                    'alert-success':        colors.green['900'],
                    'alert-warning':        colors.amber['900'],
                    'alert-error':          colors.rose['900'],
                    'dropdown':             colors.gray['700'],
                    'dropdown-hover':       colors.gray['800'],
                    'input':                colors.slate['400'],
                    'input-success':        colors.green['500'],
                    'input-error':          colors.rose['400'],
                    'input-disabled':       colors.zinc['600'],
                    'placeholder':          colors.slate['600'],
                    'placeholder-disabled': colors.zinc['600'],
                },
                dark: {
                    'default':              colors.slate['400'],
                    'title':                colors.slate['300'],
                    'primary':              colors.fuchsia['400'],
                    'info':                 colors.sky['400'],
                    'success':              colors.green['500'],
                    'warning':              colors.amber['500'],
                    'error':                colors.rose['400'],
                    'btn-default':          colors.slate['100'],
                    'btn-primary':          colors.fuchsia['100'],
                    'btn-info':             colors.sky['100'],
                    'btn-success':          colors.green['100'],
                    'btn-warning':          colors.amber['100'],
                    'btn-error':            colors.rose['100'],
                    'alert-default':        colors.slate['900'],
                    'alert-primary':        colors.fuchsia['900'],
                    'alert-info':           colors.sky['900'],
                    'alert-success':        colors.green['900'],
                    'alert-warning':        colors.amber['900'],
                    'alert-error':          colors.rose['900'],
                    'dropdown':             colors.gray['700'],
                    'dropdown-hover':       colors.gray['800'],
                    'input':                colors.slate['400'],
                    'input-success':        colors.green['500'],
                    'input-error':          colors.rose['400'],
                    'input-disabled':       colors.zinc['600'],
                    'placeholder':          colors.slate['600'],
                    'placeholder-disabled': colors.zinc['600'],
                },
            },
            textDecorationColor: {
                light: {
                    'link':       colors.amber['800'],
                    'link-hover': colors.amber['600'],
                },
                dark: {
                    'link':       colors.amber['800'],
                    'link-hover': colors.amber['600'],
                },
            },
        },
    },
    darkMode: 'class',
};

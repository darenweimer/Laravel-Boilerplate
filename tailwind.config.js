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
            colors: {
                neutral: {
                    350: colors.neutral['350'] = '#b8b8b8',
                },
            },
            borderColor: {
                light: {
                    'default':        colors.neutral['600'],
                    'primary':        colors.fuchsia['800'],
                    'info':           colors.sky['700'],
                    'success':        colors.green['700'],
                    'warning':        colors.amber['800'],
                    'error':          colors.rose['800'],
                    'input':          colors.sky['600'],
                    'input-focused':  colors.sky['300'],
                    'input-success':  colors.green['500'],
                    'input-error':    colors.rose['400'],
                    'input-disabled': colors.neutral['600'],
                },
                dark: {
                    'default':        colors.neutral['600'],
                    'primary':        colors.fuchsia['800'],
                    'info':           colors.sky['700'],
                    'success':        colors.green['700'],
                    'warning':        colors.amber['800'],
                    'error':          colors.rose['800'],
                    'input':          colors.sky['600'],
                    'input-focused':  colors.sky['300'],
                    'input-success':  colors.green['500'],
                    'input-error':    colors.rose['400'],
                    'input-disabled': colors.neutral['600'],
                },
            },
            backgroundColor: {
                light: {
                    'canvas':         colors.neutral['900'],
                    'default':        colors.neutral['800'],
                    'btn-default':    colors.neutral['600'],
                    'btn-primary':    colors.fuchsia['800'],
                    'btn-info':       colors.sky['700'],
                    'btn-success':    colors.green['800'],
                    'btn-warning':    colors.amber['800'],
                    'btn-error':      colors.rose['800'],
                    'alert-default':  colors.neutral['300'],
                    'alert-primary':  colors.fuchsia['300'],
                    'alert-info':     colors.sky['300'],
                    'alert-success':  colors.green['300'],
                    'alert-warning':  colors.amber['300'],
                    'alert-error':    colors.rose['300'],
                    'dropdown':       colors.neutral['300'],
                    'dropdown-hover': colors.neutral['350'],
                    'input-disabled': colors.neutral['800'],
                },
                dark: {
                    'canvas':         colors.neutral['900'],
                    'default':        colors.neutral['800'],
                    'btn-default':    colors.neutral['600'],
                    'btn-primary':    colors.fuchsia['800'],
                    'btn-info':       colors.sky['700'],
                    'btn-success':    colors.green['800'],
                    'btn-warning':    colors.amber['800'],
                    'btn-error':      colors.rose['800'],
                    'alert-default':  colors.neutral['300'],
                    'alert-primary':  colors.fuchsia['300'],
                    'alert-info':     colors.sky['300'],
                    'alert-success':  colors.green['300'],
                    'alert-warning':  colors.amber['300'],
                    'alert-error':    colors.rose['300'],
                    'dropdown':       colors.neutral['300'],
                    'dropdown-hover': colors.neutral['350'],
                    'input-disabled': colors.neutral['800'],
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
                    'default':              colors.neutral['350'],
                    'title':                colors.neutral['300'],
                    'primary':              colors.fuchsia['400'],
                    'info':                 colors.sky['400'],
                    'success':              colors.green['500'],
                    'warning':              colors.amber['500'],
                    'error':                colors.rose['400'],
                    'btn-default':          colors.neutral['100'],
                    'btn-primary':          colors.fuchsia['50'],
                    'btn-info':             colors.sky['50'],
                    'btn-success':          colors.green['50'],
                    'btn-warning':          colors.amber['50'],
                    'btn-error':            colors.rose['50'],
                    'alert-default':        colors.neutral['900'],
                    'alert-primary':        colors.fuchsia['900'],
                    'alert-info':           colors.sky['900'],
                    'alert-success':        colors.green['900'],
                    'alert-warning':        colors.amber['900'],
                    'alert-error':          colors.rose['900'],
                    'dropdown':             colors.neutral['700'],
                    'dropdown-hover':       colors.neutral['900'],
                    'input':                colors.neutral['400'],
                    'input-success':        colors.green['500'],
                    'input-error':          colors.rose['400'],
                    'input-disabled':       colors.neutral['600'],
                    'placeholder':          colors.neutral['600'],
                    'placeholder-disabled': colors.neutral['600'],
                },
                dark: {
                    'default':              colors.neutral['350'],
                    'title':                colors.neutral['300'],
                    'primary':              colors.fuchsia['400'],
                    'info':                 colors.sky['400'],
                    'success':              colors.green['500'],
                    'warning':              colors.amber['500'],
                    'error':                colors.rose['400'],
                    'btn-default':          colors.neutral['100'],
                    'btn-primary':          colors.fuchsia['50'],
                    'btn-info':             colors.sky['50'],
                    'btn-success':          colors.green['50'],
                    'btn-warning':          colors.amber['50'],
                    'btn-error':            colors.rose['50'],
                    'alert-default':        colors.neutral['900'],
                    'alert-primary':        colors.fuchsia['900'],
                    'alert-info':           colors.sky['900'],
                    'alert-success':        colors.green['900'],
                    'alert-warning':        colors.amber['900'],
                    'alert-error':          colors.rose['900'],
                    'dropdown':             colors.neutral['700'],
                    'dropdown-hover':       colors.neutral['900'],
                    'input':                colors.neutral['400'],
                    'input-success':        colors.green['500'],
                    'input-error':          colors.rose['400'],
                    'input-disabled':       colors.neutral['600'],
                    'placeholder':          colors.neutral['600'],
                    'placeholder-disabled': colors.neutral['600'],
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

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
            pattern: /(border|bg|text)-(alert|btn|card)-.+/,
            variants: [
                'active',
                'disabled',
                'focus',
                'hover',
            ],
        },
        {
            pattern: /font-(thin|normal|medium|bold|black)/,
        },
    ],
    theme: {
        container: {
            center: true,
            // screens: screens,
        },
        extend: {
            ringColor: {
                'input':  colors.blue['100'],
                'button': colors.blue['200'],
            },
            borderColor: {
                'default':         colors.neutral['300'],
                'alert-primary':   colors.blue['400'],
                'alert-secondary': colors.purple['400'],
                'alert-success':   colors.green['400'],
                'alert-warning':   colors.orange['400'],
                'alert-error':     colors.red['400'],
                'alert-default':   colors.neutral['400'],
                'btn-primary':     colors.blue['900'],
                'btn-secondary':   colors.purple['900'],
                'btn-success':     colors.green['900'],
                'btn-warning':     colors.yellow['900'],
                'btn-error':       colors.red['900'],
                'btn-default':     colors.neutral['500'],
                'card-primary':    colors.blue['300'],
                'card-secondary':  colors.purple['300'],
                'card-success':    colors.emerald['300'],
                'card-warning':    colors.orange['300'],
                'card-error':      colors.red['300'],
                'card-default':    colors.neutral['300'],
                'dropdown':        colors.neutral['400'],
                'input-normal':    colors.neutral['400'],
                'input-focused':   colors.blue['300'],
                'input-invalid':   colors.red['600'],
            },
            backgroundColor: {
                'default':               colors.white,
                'alert-primary':         colors.blue['100'],
                'alert-secondary':       colors.purple['100'],
                'alert-success':         colors.green['100'],
                'alert-warning':         colors.orange['100'],
                'alert-error':           colors.red['100'],
                'alert-default':         colors.neutral['100'],
                'btn-primary-normal':    colors.blue['600'],
                'btn-primary-hover':     colors.blue['700'],
                'btn-primary-active':    colors.blue['800'],
                'btn-secondary-normal':  colors.purple['600'],
                'btn-secondary-hover':   colors.purple['700'],
                'btn-secondary-active':  colors.purple['800'],
                'btn-success-normal':    colors.green['600'],
                'btn-success-hover':     colors.green['700'],
                'btn-success-active':    colors.green['800'],
                'btn-warning-normal':    colors.yellow['600'],
                'btn-warning-hover':     colors.yellow['700'],
                'btn-warning-active':    colors.yellow['800'],
                'btn-error-normal':      colors.red['600'],
                'btn-error-hover':       colors.red['700'],
                'btn-error-active':      colors.red['800'],
                'btn-default-normal':    colors.neutral['200'],
                'btn-default-hover':     colors.neutral['300'],
                'btn-default-active':    colors.neutral['400'],
                'card-primary-header':   colors.blue['100'],
                'card-primary-body':     colors.blue['50'],
                'card-primary-footer':   colors.blue['100'],
                'card-secondary-header': colors.purple['100'],
                'card-secondary-body':   colors.purple['50'],
                'card-secondary-footer': colors.purple['100'],
                'card-success-header':   colors.emerald['100'],
                'card-success-body':     colors.emerald['50'],
                'card-success-footer':   colors.emerald['100'],
                'card-warning-header':   colors.orange['100'],
                'card-warning-body':     colors.orange['50'],
                'card-warning-footer':   colors.orange['100'],
                'card-error-header':     colors.red['100'],
                'card-error-body':       colors.red['50'],
                'card-error-footer':     colors.red['100'],
                'card-default-header':   colors.neutral['100'],
                'card-default-body':     colors.white,
                'card-default-footer':   colors.neutral['100'],
                'dropdown-normal':       colors.white,
                'dropdown-highlight':    colors.gray['200'],
                'input-normal':          colors.white,
                'input-disabled':        colors.neutral['100'],
                'input-invalid':         colors.red['50'],
            },
            fontFamily: {
                'default': ['Roboto'],
                'title':   ['Armata'],
            },
            fontWeight: {
                'thin':   100,
                'normal': 300,
                'medium': 400,
                'bold':   700,
                'black':  900,
            },
            textColor: {
                'default':               colors.neutral['700'],
                'link':                  colors.blue['500'],
                'success':               colors.green['600'],
                'error':                 colors.red['600'],
                'alert-primary':         colors.blue['700'],
                'alert-secondary':       colors.purple['700'],
                'alert-success':         colors.green['700'],
                'alert-warning':         colors.orange['700'],
                'alert-error':           colors.red['800'],
                'alert-default':         colors.neutral['700'],
                'btn-primary':           colors.white,
                'btn-secondary':         colors.white,
                'btn-success':           colors.white,
                'btn-warning':           colors.white,
                'btn-error':             colors.white,
                'btn-default':           colors.neutral['700'],
                'card-primary-header':   colors.blue['800'],
                'card-primary-body':     colors.blue['900'],
                'card-primary-footer':   colors.blue['800'],
                'card-secondary-header': colors.purple['800'],
                'card-secondary-body':   colors.purple['900'],
                'card-secondary-footer': colors.purple['800'],
                'card-success-header':   colors.emerald['800'],
                'card-success-body':     colors.emerald['900'],
                'card-success-footer':   colors.emerald['800'],
                'card-warning-header':   colors.orange['800'],
                'card-warning-body':     colors.orange['900'],
                'card-warning-footer':   colors.orange['800'],
                'card-error-header':     colors.red['800'],
                'card-error-body':       colors.red['900'],
                'card-error-footer':     colors.red['800'],
                'card-default-header':   colors.neutral['600'],
                'card-default-body':     colors.neutral['700'],
                'card-default-footer':   colors.neutral['600'],
                'dropdown-normal':       colors.neutral['700'],
                'dropdown-highlight':    colors.neutral['700'],
                'input-normal':          colors.neutral['700'],
                'input-disabled':        colors.neutral['400'],
                'input-invalid':         colors.red['600'],
            },
            placeholderColor: {
                'input': colors.neutral['400'],
            },
        },
    },
};

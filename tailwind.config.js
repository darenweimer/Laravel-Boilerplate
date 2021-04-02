const colors = require('tailwindcss/colors');

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        container: {
            center: true,
        },
        extend: {
            borderColor: {
                'button-submit': colors.blue['900'],
                'button-cancel': colors.trueGray['500'],
                'button-add': colors.green['900'],
                'button-remove': colors.red['900'],
                'button-other': colors.yellow['900'],
                'card': colors.trueGray['300'],
            },
            backgroundColor: {
                'button-submit': colors.blue['600'],
                'button-submit-hover': colors.blue['700'],
                'button-submit-active': colors.blue['800'],
                'button-cancel': colors.trueGray['200'],
                'button-cancel-hover': colors.trueGray['300'],
                'button-cancel-active': colors.trueGray['400'],
                'button-add': colors.green['600'],
                'button-add-hover': colors.green['700'],
                'button-add-active': colors.green['800'],
                'button-remove': colors.red['600'],
                'button-remove-hover': colors.red['700'],
                'button-remove-active': colors.red['800'],
                'button-other': colors.yellow['600'],
                'button-other-hover': colors.yellow['700'],
                'button-other-active': colors.yellow['800'],
                'card-header': colors.trueGray['100'],
                'card-body': colors.white,
                'card-footer': colors.trueGray['100'],
            },
            textColor: {
                'button-submit': colors.white,
                'button-cancel': colors.black,
                'button-add': colors.white,
                'button-remove': colors.white,
                'button-other': colors.white,
            },
            fontFamily: {
                sans: [
                    'Roboto',
                ],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: [
                'active',
            ],
            opacity: [
                'disabled',
            ],
        },
    },
    plugins: [
        //
    ],
};

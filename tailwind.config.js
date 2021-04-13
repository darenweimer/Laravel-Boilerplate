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
            ringColor: {
                'input': colors.blue['100'],
                'button': colors.blue['200'],
            },
            borderColor: {
                'btn-primary': colors.blue['900'],
                'btn-secondary': colors.yellow['900'],
                'btn-create': colors.green['900'],
                'btn-delete': colors.red['900'],
                'btn-cancel': colors.trueGray['500'],
                'card': colors.trueGray['300'],
                'input': colors.trueGray['300'],
                'input-focus': colors.blue['300'],
                'input-invalid': colors.red['600'],
            },
            backgroundColor: {
                'primary': colors.white,
                'btn-primary': colors.blue['600'],
                'btn-primary-hover': colors.blue['700'],
                'btn-primary-active': colors.blue['800'],
                'btn-secondary': colors.yellow['600'],
                'btn-secondary-hover': colors.yellow['700'],
                'btn-secondary-active': colors.yellow['800'],
                'btn-create': colors.green['600'],
                'btn-create-hover': colors.green['700'],
                'btn-create-active': colors.green['800'],
                'btn-delete': colors.red['600'],
                'btn-delete-hover': colors.red['700'],
                'btn-delete-active': colors.red['800'],
                'btn-cancel': colors.trueGray['200'],
                'btn-cancel-hover': colors.trueGray['300'],
                'btn-cancel-active': colors.trueGray['400'],
                'card-header': colors.trueGray['100'],
                'card-body': colors.white,
                'card-footer': colors.trueGray['100'],
                'input': colors.white,
                'input-disabled': colors.trueGray['100'],
                'input-invalid': colors.red['50'],
            },
            fontFamily: {
                sans: [
                    'Roboto',
                ],
            },
            fontWeight: {
                thin: 100,
                normal: 300,
                medium: 400,
                bold: 700,
                black: 900,
            },
            textColor: {
                'primary': colors.trueGray['700'],
                'link': colors.blue['500'],
                'btn-primary': colors.white,
                'btn-secondary': colors.white,
                'btn-create': colors.white,
                'btn-delete': colors.white,
                'btn-cancel': colors.trueGray['700'],
                'card-header': colors.trueGray['700'],
                'card-body': colors.trueGray['700'],
                'card-footer': colors.trueGray['700'],
                'input': colors.trueGray['700'],
                'input-disabled': colors.trueGray['400'],
                'input-invalid': colors.red['900'],
                'input-success': colors.green['600'],
                'input-error': colors.red['600'],
            },
            placeholderColor: {
                'input': colors.trueGray['300'],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: [
                'active',
                'disabled',
            ],
            textColor: [
                'disabled',
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

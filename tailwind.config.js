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
            textColor: {
                //
            },
            backgroundColor: {
                'card-header': colors.trueGray['100'],
                'card-body': colors.white,
                'card-footer': colors.trueGray['100'],
            },
            borderColor: {
                'card': colors.trueGray['300'],
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

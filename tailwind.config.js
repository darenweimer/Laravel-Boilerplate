const defaultTheme = require('tailwindcss/defaultTheme');

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
                //
            },
            borderColor: {
                //
            },
            fontFamily: {
                sans: [
                    'Roboto',
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            fontWeight: {
                light: 100,
                normal: 300,
                bold: 700,
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
};

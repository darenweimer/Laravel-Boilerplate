const colors = require('tailwindcss/colors');

module.exports = {
    theme: {
        container: {
            center: true,
        },
        extend: {
            ringColor: {
                input: colors.blue['100'],
                button: colors.blue['200'],
            },
            borderColor: {
                alert: {
                    primary: colors.blue['400'],
                    secondary: colors.purple['400'],
                    success: colors.emerald['400'],
                    warning: colors.orange['400'],
                    danger: colors.red['400'],
                    default: colors.trueGray['400'],
                },
                btn: {
                    primary: colors.blue['900'],
                    secondary: colors.purple['900'],
                    success: colors.green['900'],
                    warning: colors.yellow['900'],
                    danger: colors.red['900'],
                    default: colors.trueGray['500'],
                },
                card: {
                    primary: colors.blue['200'],
                    secondary: colors.purple['200'],
                    success: colors.emerald['200'],
                    warning: colors.orange['200'],
                    danger: colors.red['200'],
                    default: colors.trueGray['300'],
                },
                input: {
                    normal: colors.trueGray['300'],
                    focused: colors.blue['300'],
                    invalid: colors.red['600'],
                },
                dropdown: colors.trueGray['300'],
            },
            backgroundColor: {
                default: colors.white,
                alert: {
                    primary: colors.blue['100'],
                    secondary: colors.purple['100'],
                    success: colors.emerald['100'],
                    warning: colors.orange['100'],
                    danger: colors.red['100'],
                    default: colors.trueGray['100'],
                },
                btn: {
                    primary: {
                        normal: colors.blue['600'],
                        hover: colors.blue['700'],
                        active: colors.blue['800'],
                    },
                    secondary: {
                        normal: colors.purple['600'],
                        hover: colors.purple['700'],
                        active: colors.purple['800'],
                    },
                    success: {
                        normal: colors.green['600'],
                        hover: colors.green['700'],
                        active: colors.green['800'],
                    },
                    warning: {
                        normal: colors.yellow['600'],
                        hover: colors.yellow['700'],
                        active: colors.yellow['800'],
                    },
                    danger: {
                        normal: colors.red['600'],
                        hover: colors.red['700'],
                        active: colors.red['800'],
                    },
                    default: {
                        normal: colors.trueGray['200'],
                        hover: colors.trueGray['300'],
                        active: colors.trueGray['400'],
                    },
                },
                card: {
                    primary: {
                        header: colors.blue['100'],
                        body: colors.blue['50'],
                        footer: colors.blue['100'],
                    },
                    secondary: {
                        header: colors.purple['100'],
                        body: colors.purple['50'],
                        footer: colors.purple['100'],
                    },
                    success: {
                        header: colors.emerald['100'],
                        body: colors.emerald['50'],
                        footer: colors.emerald['100'],
                    },
                    warning: {
                        header: colors.orange['100'],
                        body: colors.orange['50'],
                        footer: colors.orange['100'],
                    },
                    danger: {
                        header: colors.red['100'],
                        body: colors.red['50'],
                        footer: colors.red['100'],
                    },
                    default: {
                        header: colors.trueGray['100'],
                        body: colors.white,
                        footer: colors.trueGray['100'],
                    },
                },
                input: {
                    normal: colors.white,
                    disabled: colors.trueGray['100'],
                    invalid: colors.red['50'],
                },
                dropdown: {
                    normal: colors.white,
                    highlight: colors.trueGray['200'],
                },
            },
            fontFamily: {
                default: [
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
                default: colors.trueGray['700'],
                link: colors.blue['500'],
                alert: {
                    primary: colors.blue['700'],
                    secondary: colors.purple['700'],
                    success: colors.emerald['700'],
                    warning: colors.orange['700'],
                    danger: colors.red['800'],
                    default: colors.trueGray['700'],
                },
                btn: {
                    primary: colors.white,
                    secondary: colors.white,
                    success: colors.white,
                    warning: colors.white,
                    danger: colors.white,
                    default: colors.trueGray['700'],
                },
                card: {
                    primary: {
                        header: colors.blue['800'],
                        body: colors.blue['900'],
                        footer: colors.blue['800'],
                    },
                    secondary: {
                        header: colors.purple['800'],
                        body: colors.purple['900'],
                        footer: colors.purple['800'],
                    },
                    success: {
                        header: colors.emerald['800'],
                        body: colors.emerald['900'],
                        footer: colors.emerald['800'],
                    },
                    warning: {
                        header: colors.orange['800'],
                        body: colors.orange['900'],
                        footer: colors.orange['800'],
                    },
                    danger: {
                        header: colors.red['800'],
                        body: colors.red['900'],
                        footer: colors.red['800'],
                    },
                    default: {
                        header: colors.trueGray['600'],
                        body: colors.trueGray['700'],
                        footer: colors.trueGray['600'],
                    },
                },
                input: {
                    normal: colors.trueGray['700'],
                    disabled: colors.trueGray['400'],
                    valid: colors.green['700'],
                    invalid: colors.red['600'],
                },
                dropdown: {
                    normal: colors.trueGray['700'],
                    highlight: colors.trueGray['700'],
                },
            },
            placeholderColor: {
                input: colors.trueGray['400'],
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

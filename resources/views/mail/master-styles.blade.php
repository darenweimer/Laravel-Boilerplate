<style>
    @for ($i = 1; $i <= 20; $i++)
        .m-{{ $i }} {
            margin: {{ $i * 0.25 }}rem;
        }

        .p-{{ $i }} {
            padding: {{ $i * 0.25 }}rem;
        }

        @foreach (['l' => 'left', 'r' => 'right', 't' => 'top', 'b' => 'bottom'] as $k => $v)
            .m{{ $k }}-{{ $i }} {
                margin-{{ $v }}: {{ $i * 0.25 }}rem;
            }

            .p{{ $k }}-{{ $i }} {
                padding-{{ $v }}: {{ $i * 0.25 }}rem;
            }
        @endforeach
    @endfor

    .overflow-scroll {
        overflow: scroll;
    }

    .rounded-md {
        border-radius: 0.375rem;
    }

    .bg-default {
        background-color: white;
    }

    .bg-pre {
        background-color: #ddd;
    }

    .font-default {
        font-family: 'Noto Sans Display';
    }

    .font-title {
        font-family: 'Inconsolata';
    }

    .font-thin {
        font-weight: 250;
    }

    .font-normal {
        font-weight: 375;
    }

    .font-semibold {
        font-weight: 550;
    }

    .font-bold {
        font-weight: 700;
    }

    .font-black {
        font-weight: 900;
    }

    .text-xs {
        font-size: 0.75rem;
        line-height: 1.00rem;
    }

    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    .text-base {
        font-size: 1.00rem;
        line-height: 1.50rem;
    }

    .text-lg {
        font-size: 1.125rem;
        line-height: 1.75rem;
    }

    .text-xl {
        font-size: 1.25rem;
        line-height: 1.75rem;
    }

    .text-2xl {
        font-size: 1.50rem;
        line-height: 2.00rem;
    }

    .text-3xl {
        font-size: 1.875rem;
        line-height: 2.25rem;
    }

    .text-default {
        color: #333;
    }

    .text-link {
        color: #09c;
    }

    .text-success {
        color: #0a0;
    }

    .text-error {
        color: #c00;
    }

    .tracking-wide {
        letter-spacing: 0.025em;
    }

    .text-center {
        text-align: center;
    }

    .antialiased {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>

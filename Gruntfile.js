'use strict';

module.exports = function(grunt) {
    grunt.initConfig({
        jshint: {
            all: [
                'Gruntfile.js',
                'web/js/*.js'
            ],
            options: {
                jshintrc: '.jshintrc'
            }
        },
        php: {
            dev: {
                options: {
                    hostname: 'localhost',
                    port: 8000,
                    base: 'web',
                    open: true,
                    keepalive: true
                }
            }
        },
        phpcs: {
            options: {
                bin: 'vendor/bin/phpcs',
                standard: 'PSR2'
            },
            application: {
                src: ['src/**/*.php']
            }
        },
        phpcpd: {
            application: {
                dir: 'src'
            },
            options: {
                bin: 'vendor/bin/phpcpd',
                quiet: true
            }
        },
        phpmd: {
            application: {
                dir: 'src'
            },
            options: {
                bin: 'vendor/bin/phpmd',
                reportFormat: 'text'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-php');
    grunt.loadNpmTasks('grunt-phpcpd');
    grunt.loadNpmTasks('grunt-phpcs');
    grunt.loadNpmTasks('grunt-phpmd');

    grunt.registerTask('default', ['jshint', 'phpcs']);
    grunt.registerTask('serve', [
        'php:dev'
    ]);
};

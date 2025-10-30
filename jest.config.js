module.exports = {
    testEnvironment: 'node',
    roots: ['<rootDir>/tests/Unit'],
    testMatch: ['**/*.test.js'],
    coverageDirectory: 'coverage-js',
    collectCoverageFrom: [
        'public/js/**/*.js',
        '!public/js/**/*.min.js'
    ]
};

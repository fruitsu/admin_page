export default {
    data() {
        return {
            type: 'password',
            password: ''
        }
    },

    methods: {
        switchType() {
            this.type = this.type === 'password' ? 'text' : 'password';
        },

        randomPassword() {
            this.type = 'text';
            this.password = Array(8)
                .fill('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@-$')
                .map(x => x[Math.floor(crypto.getRandomValues(new Uint32Array(1))[0] / (0xffffffff + 1) * x.length)])
                .join('')
        }
    }
}

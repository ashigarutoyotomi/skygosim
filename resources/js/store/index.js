import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        user: null,
        settings: null,
    },

    mutations: {
        setUser(state, user) {
            state.user = user;
        }
    },

    actions: {
        loadMe({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get('/me')
                    .then(({data}) => {
                        commit('setUser', data);

                        resolve();
                    })
                    .catch(e => {
                        reject(e);
                    })
            });
        }
    },

    getters: {
        getUser: state => {
            return state.user;
        }
    }
})

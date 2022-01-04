/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import { createApp } from 'vue'

import FollowButton from './components/FollowButton.vue'

const app = createApp({});

app.component('followbutton', FollowButton);

app.mount('#app');



import axios from 'axios';
const API_BASE = 'http://127.0.0.1:8000/api';

export const getMenu = async () => (await axios.get(`${API_BASE}/menus`)).data;
export const getPages = async () => (await axios.get(`${API_BASE}/pages`)).data;
export const getPage = async (slug) => (await axios.get(`${API_BASE}/pages/${slug}`)).data;
export const getPosts = async () => (await axios.get(`${API_BASE}/posts`)).data.data;
export const getPost = async (slug) => (await axios.get(`${API_BASE}/posts/${slug}`)).data;

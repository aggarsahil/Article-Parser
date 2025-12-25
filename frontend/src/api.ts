import axios from 'axios';

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
});

export const fetchArticles = () => api.get('/articles');
export const fetchArticle = (id: string | number) => api.get(`/articles/${id}`);

import { useEffect, useState } from 'react';
import { fetchArticles } from '../api';
import { Link } from 'react-router-dom';

interface Article {
  id: number;
  title: string;
  created_at: string;
}

export default function ArticleList() {
  const [articles, setArticles] = useState<Article[]>([]);

  useEffect(() => {
    fetchArticles().then(res => setArticles(res.data));
  }, []);

  return (
    <div className="container">
      <h1>BeyondChats Articles</h1>
      <div className="grid">
        {articles.map(a => (
          <Link key={a.id} to={`/articles/${a.id}`} className="card">
            <h2>{a.title}</h2>
            <p>{new Date(a.created_at).toLocaleDateString()}</p>
          </Link>
        ))}
      </div>
    </div>
  );
}

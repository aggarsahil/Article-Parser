// src/pages/ArticleDetail.tsx
import { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import { fetchArticle } from '../api';

interface Article {
  id: number;
  title: string;
  content: string;
  source_url: string;
}

export default function ArticleDetail() {
  const { id } = useParams();
  const [article, setArticle] = useState<Article | null>(null);

  useEffect(() => {
    if (!id) return;
    fetchArticle(id).then(res => setArticle(res.data));
  }, [id]);

  if (!article) return <div>Loading...</div>;

  return (
    <div className="container" style={{borderRadius:2 ,borderColor:'white'}}>
      <Link to="/">← Back</Link>
      <h1>{article.title}</h1>
      <div
        className="content"
        dangerouslySetInnerHTML={{ __html: article.content }}
      />
      <p>
        Original source:{' '}
        <a href={article.source_url} target="_blank" rel="noreferrer">
          {article.source_url}
        </a>
      </p>
    </div>
  );
}

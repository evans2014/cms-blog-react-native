import React, { useEffect, useState } from 'react';
import {ScrollView, Text, View, Platform, Image} from 'react-native';
import { getPost } from '../api/api';

export default function PostDetailScreen({ route }) {
  const { slug } = route.params;
  const [post, setPost] = useState(null);

  useEffect(() => {
    const fetchPost = async () => {
      try {
        const res = await getPost(slug);
        setPost(res);
      } catch (err) {
        console.error(err);
      }
    };
    fetchPost();
  }, [slug]);

  if (!post) return <Text>Loading...</Text>;

  const HtmlRenderer = ({ html }) => {
    if (Platform.OS === 'web') {
      return <div dangerouslySetInnerHTML={{ __html: html }} />;
    }
    const RenderHtml = require('react-native-render-html').default;
    return <RenderHtml contentWidth={400} source={{ html }} />;
  };

  return (

    <ScrollView style={{ padding: 20 }}>
      <Text style={{ fontSize: 24, fontWeight: 'bold', marginBottom: 15 }}>
        {post.title}
      </Text>
      {post.image && (
        <Image
          source={{ uri: post.image }}
          style={{
            width: '100%',
            height: 250,
            borderRadius: 12,
            marginBottom: 15
          }}
          resizeMode="cover"
        />
      )}
      <HtmlRenderer html={post.content} />
    </ScrollView>
  );
}
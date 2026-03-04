import React, { useEffect, useState } from 'react';
import {View, Text, ScrollView, Button, ActivityIndicator, Image} from 'react-native';
import { getPosts } from '../api/api';
import HtmlRenderer from '../components/HtmlRenderer';

export default function NewsScreen({ navigation }) {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchPosts = async () => {
      try {
        const data = await getPosts();
        // Проверка дали data е масив
        setPosts(Array.isArray(data) ? data : data.data || []);
      } catch (error) {
        console.error('Error fetching posts:', error);
      } finally {
        setLoading(false);
      }
    };
    fetchPosts();
  }, []);

  if (loading) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
        <ActivityIndicator size="large" />
      </View>
    );
  }

  if (posts.length === 0) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 }}>
        <Text>No posts available.</Text>
      </View>
    );
  }

  return (
    <ScrollView style={{ padding: 20 }}>
      {posts.map((post) => (
        <View key={post.id} style={{ marginBottom: 25, borderBottomWidth: 1, borderColor: '#ddd', paddingBottom: 15 }}>
          {post.image && (
            <Image
              source={{ uri: post.image }}
              style={{
                width: '100%',
                height: 200,
                borderRadius: 10,
                marginBottom: 10
              }}
              resizeMode="cover"
            />
          )}
          <Text style={{ fontSize: 22, fontWeight: 'bold', marginBottom: 8 }}>{post.title}</Text>
          <HtmlRenderer html={post.content} />
          <Button
            title="Read more"
            onPress={() => navigation.navigate('PostDetail', { slug: post.slug })}
          />
        </View>
      ))}
    </ScrollView>
  );
}
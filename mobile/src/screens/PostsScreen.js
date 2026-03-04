import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, Button ,Image} from 'react-native';
import { getPosts } from '../api/api';

export default function PostsScreen({ navigation }) {
  const [posts, setPosts] = useState([]);

  useEffect(() => {
    const fetchPosts = async () => {
      try {
        const res = await getPosts();

        setPosts(res.data);
      } catch (err) {
        console.error(err);
      }
    };
    fetchPosts();
  }, []);

  return (
    <ScrollView style={{ padding: 20 }}>
      {posts.map((post) => (
        <View key={post.id} style={{ marginBottom: 20 }}>

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

          <Text style={{ fontSize: 20, fontWeight: 'bold' }}>
            {post.title}
          </Text>

          <Button
            title="Read more"
            onPress={() =>
              navigation.navigate('PostDetail', { slug: post.slug })
            }
          />
        </View>
      ))}
    </ScrollView>
  );
}
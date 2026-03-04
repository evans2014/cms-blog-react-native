import React, { useEffect, useState, useRef } from 'react';
import {
  View,
  Text,
  FlatList,
  Image,
  TouchableOpacity,
  Dimensions,
  StyleSheet,
} from 'react-native';
import { getPosts, getPage } from '../api/api';

const { width } = Dimensions.get('window');

export default function HomeScreen({ navigation }) {
  const [posts, setPosts] = useState([]);
  const [homePage, setHomePage] = useState(null);
  const [currentIndex, setCurrentIndex] = useState(0);

  const flatListRef = useRef();

  useEffect(() => {
    const fetchData = async () => {
      const postsRes = await getPosts();
      setPosts(postsRes ?? []);
      const homeRes = await getPage('home');
      setHomePage(homeRes);
    };
    fetchData();
  }, []);

  const onViewRef = useRef(({ viewableItems }) => {
    if (viewableItems.length > 0) setCurrentIndex(viewableItems[0].index);
  });

  const viewConfigRef = useRef({ viewAreaCoveragePercentThreshold: 50 });

  const goToIndex = (index) => {
    flatListRef.current?.scrollToIndex({ index, animated: true });
    setCurrentIndex(index);
  };

  // 🔹 Фиксирано getItemLayout за scrollToIndex
  const getItemLayout = (_, index) => ({
    length: width,
    offset: width * index,
    index,
  });

  return (
    <View style={{ flex: 1 }}>
      {posts.length > 0 ? (
        <View>
          <FlatList
            ref={flatListRef}
            data={posts}
            keyExtractor={(item) => item.id.toString()}
            horizontal
            pagingEnabled
            showsHorizontalScrollIndicator={false}
            renderItem={({ item }) => (
              <TouchableOpacity
                activeOpacity={0.8}
                onPress={() =>
                  navigation.navigate('PostDetail', { slug: item.slug })
                }
              >
                <View style={{ width, height: 250 }}>
                  {item.image && (
                    <Image
                      source={{ uri: item.image }}
                      style={{ width: '100%', height: '100%' }}
                      resizeMode="cover"
                    />
                  )}
                  <View style={styles.overlay}>
                    <Text style={styles.title}>{item.title}</Text>
                  </View>
                </View>
              </TouchableOpacity>
            )}
            onViewableItemsChanged={onViewRef.current}
            viewabilityConfig={viewConfigRef.current}
            getItemLayout={getItemLayout} 
          />

          {/* 🔵 Dots */}
          <View style={styles.dotsContainer}>
            {posts.map((_, idx) => (
              <TouchableOpacity key={idx} onPress={() => goToIndex(idx)}>
                <View
                  style={[
                    styles.dot,
                    currentIndex === idx ? styles.activeDot : null,
                  ]}
                />
              </TouchableOpacity>
            ))}
          </View>
        </View>
      ) : (
        <Text style={{ padding: 20 }}>Loading posts...</Text>
      )}

      {/* Home content */}
      {homePage && (
        <View style={{ padding: 20 }}>
          <Text style={{ fontSize: 26, fontWeight: 'bold', marginBottom: 15 }}>
            {homePage.title}
          </Text>
          <Text style={{ fontSize: 16, lineHeight: 22 }}>
            {homePage.content.replace(/<[^>]*>/g, '')}
          </Text>
        </View>
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  overlay: {
    position: 'absolute',
    bottom: 0,
    width: '100%',
    backgroundColor: 'rgba(0,0,0,0.5)',
    padding: 10,
  },
  title: {
    color: '#fff',
    fontSize: 18,
    fontWeight: 'bold',
  },
  dotsContainer: {
    flexDirection: 'row',
    justifyContent: 'center',
    marginTop: 10,
    marginBottom: 15,
  },
  dot: {
    width: 10,
    height: 10,
    borderRadius: 5,
    backgroundColor: '#ccc',
    marginHorizontal: 5,
  },
  activeDot: {
    backgroundColor: '#333',
  },
});
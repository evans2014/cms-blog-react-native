import React, { useEffect, useState } from 'react';
import { ScrollView, useWindowDimensions } from 'react-native';
import RenderHtml from 'react-native-render-html';
import { getPage } from '../api/api';

export default function PageScreen({ route, navigation }) {
  const { slug } = route.params;
  const [page, setPage] = useState(null);
  const { width } = useWindowDimensions();

  useEffect(() => {
    const fetchPage = async () => {
      const data = await getPage(slug);
      setPage(data);
      navigation.setOptions({ title: data.title });
    };

    fetchPage();
  }, []);

  if (!page) return null;

  return (
    <ScrollView style={{ padding: 20 }}>
      <RenderHtml
        contentWidth={width}
        source={{ html: page.content }}
      />
    </ScrollView>
  );
}

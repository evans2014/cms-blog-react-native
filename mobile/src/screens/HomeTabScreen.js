import React, { useEffect } from 'react';


export default function HomeTabScreen({ navigation }) {
  useEffect(() => {
    const parent = navigation.getParent();
    parent?.navigate('PageDetail', { slug: 'home' });
  }, []);

  return null;
}
import React, { useEffect } from 'react';


export default function AboutTabScreen({ navigation }) {
  useEffect(() => {
    const parent = navigation.getParent();
    parent?.navigate('PageDetail', { slug: 'about-us' });
  }, []);

  return null;
}
import React from 'react';
import { Platform, useWindowDimensions } from 'react-native';

export default function HtmlRenderer({ html }) {
  const { width } = useWindowDimensions();
  if (Platform.OS === 'web') return <div dangerouslySetInnerHTML={{ __html: html }} />;
  const RenderHtml = require('react-native-render-html').default;
  return <RenderHtml contentWidth={width} source={{ html }} />;
}

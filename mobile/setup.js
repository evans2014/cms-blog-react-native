const fs = require('fs');
const { execSync } = require('child_process');

const folders = [
  'src/api',
  'src/components',
  'src/screens',
  'src/navigation',
  'src/styles',
  'src/assets'
];

console.log('🚀 Създаваме структурата на src/ ...');
folders.forEach(f => {
  if (!fs.existsSync(f)) fs.mkdirSync(f, { recursive: true });
});

console.log('📦 Инсталираме нужните npm пакети...');
const packages = [
  'axios',
  'react-native-render-html',
  '@react-navigation/native',
  '@react-navigation/native-stack'
];
execSync(`npm install ${packages.join(' ')} --save`, { stdio: 'inherit' });

console.log('✏️ Създаваме базови файлове...');

// src/api/api.js
fs.writeFileSync('src/api/api.js', `import axios from 'axios';
const API_BASE = 'http://127.0.0.1:8000/api';

export const getMenu = async () => (await axios.get(\`\${API_BASE}/menus\`)).data;
export const getPages = async () => (await axios.get(\`\${API_BASE}/pages\`)).data;
export const getPage = async (slug) => (await axios.get(\`\${API_BASE}/pages/\${slug}\`)).data;
export const getPosts = async () => (await axios.get(\`\${API_BASE}/posts\`)).data.data;
export const getPost = async (slug) => (await axios.get(\`\${API_BASE}/posts/\${slug}\`)).data;
`, 'utf8');

// src/components/HtmlRenderer.js
fs.writeFileSync('src/components/HtmlRenderer.js', `import React from 'react';
import { Platform, useWindowDimensions } from 'react-native';

export default function HtmlRenderer({ html }) {
  const { width } = useWindowDimensions();
  if (Platform.OS === 'web') return <div dangerouslySetInnerHTML={{ __html: html }} />;
  const RenderHtml = require('react-native-render-html').default;
  return <RenderHtml contentWidth={width} source={{ html }} />;
}
`, 'utf8');

// src/navigation/AppNavigator.js
fs.writeFileSync('src/navigation/AppNavigator.js', `import React from 'react';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import HomeScreen from '../screens/HomeScreen';
import PageScreen from '../screens/PageScreen';
import NewsScreen from '../screens/NewsScreen';
import PostDetailScreen from '../screens/PostDetailScreen';

const Stack = createNativeStackNavigator();

export default function AppNavigator() {
  return (
    <Stack.Navigator initialRouteName="Home">
      <Stack.Screen name="Home" component={HomeScreen} />
      <Stack.Screen name="Page" component={PageScreen} />
      <Stack.Screen name="Posts" component={NewsScreen} />
      <Stack.Screen name="PostDetail" component={PostDetailScreen} />
    </Stack.Navigator>
  );
}
`, 'utf8');

// src/App.js
fs.writeFileSync('src/App.js', `import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import AppNavigator from './navigation/AppNavigator';

export default function App() {
  return (
    <NavigationContainer>
      <AppNavigator />
    </NavigationContainer>
  );
}
`, 'utf8');

console.log('✅ Инсталацията е готова! Структурата е създадена и пакети са инсталирани.');
console.log('Сега можеш да добавиш screens: HomeScreen, PageScreen, NewsScreen, PostDetailScreen.');
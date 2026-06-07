# GroupApp Theme Development

This WordPress theme uses a modern Webpack-based build system for assets.

## Development Setup

### Prerequisites

- Node.js (v16 or higher)
- npm or yarn
- Local WordPress environment running on HTTPS

### Installation

```bash
npm install
```

### Development Commands

#### Start Development Server (with Hot Reloading)

```bash
npm run dev
```

This starts Webpack Dev Server on `https://groupapp.local:3000` with:

- Hot module replacement (HMR) for instant updates
- HTTPS support to match your WordPress site
- Files written to disk so WordPress can access them
- Automatic asset detection in WordPress

#### Build for Production

```bash
npm run build
```

This creates optimized, minified assets with cache-busting hashes in the `dist/` folder.

#### Development Build (without minification)

```bash
npm run build:dev
```

#### Watch Mode (no dev server)

```bash
npm run watch
```

## How It Works

### Asset Resolution

The theme automatically detects whether you're in development or production mode:

1. **Development Mode**: When `npm run dev` is running, assets are served from the Webpack Dev Server at `https://groupapp.local:3000`
2. **Production Mode**: Assets are served from the `dist/` folder with cache-busting hashes

### File Structure

```
src/
├── js/
│   ├── main.js       # Frontend JavaScript entry point
│   └── admin.js      # Admin JavaScript entry point
├── scss/
│   └── main.scss     # Main SCSS file
├── images/           # Source images
└── fonts/           # Source fonts

dist/                 # Built assets (auto-generated)
├── js/
├── css/
├── images/
└── asset-manifest.json
```

### WordPress Integration

Assets are automatically enqueued in WordPress through `functions.php`:

- `groupapp_get_asset_url()` function handles asset resolution
- Supports both development and production environments
- Automatic fallbacks if assets aren't found

## Troubleshooting

### WebSocket Connection Issues

If you see WebSocket errors in the browser console:

1. Make sure your local WordPress site is running on HTTPS
2. Ensure the dev server URL in webpack config matches your local domain
3. Check that port 3000 is available

### Assets Not Loading

1. Make sure `npm run dev` is running for development
2. For production, run `npm run build` first
3. Check that the `dist/` folder contains built files
4. Verify WordPress can access the asset URLs

### HTTPS Certificate Issues

If you get SSL certificate warnings:

1. Accept the certificate for `https://groupapp.local:3000` in your browser
2. Or configure your local environment to trust self-signed certificates

## CSS/SCSS

- Write styles in `src/scss/main.scss`
- Supports modern CSS features via PostCSS
- Autoprefixer automatically adds vendor prefixes
- Hot reloading updates styles instantly

## JavaScript

- ES6+ syntax supported via Babel
- Module system for organizing code
- Hot reloading for instant updates
- Separate bundles for frontend (`main.js`) and admin (`admin.js`)

## Images and Assets

- Place images in `src/images/`
- They'll be optimized and copied to `dist/images/`
- Use relative paths in CSS: `url('../images/photo.jpg')`
- Webpack will handle the final URLs

import EditorLayout from './controllers/editor_controller';

if (typeof window.application !== 'undefined') {
  window.application.register('layout--editor', EditorLayout);
}

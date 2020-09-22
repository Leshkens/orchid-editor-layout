import EditorLayout from './controllers/editorjs_controller';

if (typeof window.application !== 'undefined') {
  window.application.register('layout--editor', EditorLayout);
}

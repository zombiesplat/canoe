export function clone(src) {
  let return_val = {};
  try {
    return_val = JSON.parse(JSON.stringify(src));
  } catch (e) {
    return_val = {};
    console.log('Unable to clone object');
    console.log(e);
  }
  return return_val;
}

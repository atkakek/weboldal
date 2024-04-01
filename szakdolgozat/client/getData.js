async function getData(url, renderFc) {
    const response = await fetch(url)
    const data = await response.json()
    renderFc(data)
}

async function postData(url, renderFc, configObj) {
    const response = await fetch(url, configObj)
    const data = await response.json()
    renderFc(data)
}

async function logOut(url) {
    const response = await fetch(url)
    const data = await response.json()
    if(data){
        location.href='./main.php';
    }
}

async function deleteData(url, id) {
    const response = await fetch(url + '?idk=' + idk, {
        method: 'DELETE'
    });
    if (response.ok) {
        console.log('Movie deleted successfully');
    } else {
        console.error('Error deleting movie:', response.status);
    }
}
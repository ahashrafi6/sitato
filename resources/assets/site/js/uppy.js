import Uppy from '@uppy/core'
import XHRUpload from '@uppy/xhr-upload'
//import Tus from '@uppy/tus'
import AwsS3 from '@uppy/aws-s3'
import Dashboard from '@uppy/dashboard'
import Iran from '@uppy/locales/lib/fa_IR'


// public uppy
const onUploadSuccess = () =>
    (file, response) => {

        const url = response.uploadURL
        const name = file.name

        Livewire.emit('urlAdded', url, name)
    }

const uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 31000000,
        maxNumberOfFiles: 5,
        allowedFileTypes: ['image/*', '.zip'],
    }
})
    .use(Dashboard, {
        trigger: '#select-files',
    })
    .use(XHRUpload, {endpoint: '/uppy/upload'})

uppy.on('upload-success', onUploadSuccess());

// icon uppy
const onIconUploadSuccess = () =>
    (file, response) => {
        const url = response.uploadURL
        Livewire.emit('iconAdded', url)
    }
const icon_uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 2000000,
        maxNumberOfFiles: 1,
        allowedFileTypes: ['.png'],
    }
})
    .use(Dashboard, {
        trigger: '#select-icon',
    })
    .use(XHRUpload, {endpoint: '/uppy/upload'})

icon_uppy.on('upload-success', onIconUploadSuccess());


// mini_cover uppy
const onMiniCoverUploadSuccess = () =>
    (file, response) => {
        const url = response.uploadURL
        Livewire.emit('minicoverAdded', url)
    }
const mini_cover_uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 2000000,
        maxNumberOfFiles: 1,
        allowedFileTypes: ['.png'],
    }
})
    .use(Dashboard, {
        trigger: '#select-mini-cover',
    })
    .use(XHRUpload, {endpoint: '/uppy/upload'})

mini_cover_uppy.on('upload-success', onMiniCoverUploadSuccess());

// cover uppy
const onCoverUploadSuccess = () =>
    (file, response) => {
        const url = response.uploadURL
        Livewire.emit('coverAdded', url)
    }
const cover_uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 2000000,
        maxNumberOfFiles: 1,
        allowedFileTypes: ['.png'],
    }
})
    .use(Dashboard, {
        trigger: '#select-cover',
    })
    .use(XHRUpload, {endpoint: '/uppy/upload'})

cover_uppy.on('upload-success', onCoverUploadSuccess());


// cover2 uppy
const onCover2UploadSuccess = () =>
    (file, response) => {
        const url = response.uploadURL
        Livewire.emit('cover2Added', url)
    }
const cover2_uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 2000000,
        maxNumberOfFiles: 1,
        allowedFileTypes: ['.png'],
    }
})
    .use(Dashboard, {
        trigger: '#select-cover2',
    })
    .use(XHRUpload, {endpoint: '/uppy/upload'})

cover2_uppy.on('upload-success', onCover2UploadSuccess());

// main_file uppy
const onMainFileUploadSuccess = () =>
    (file, response) => {

        const name = file.name;
        const key = response.uploadURL.substr(response.uploadURL.length - 26);

        Livewire.emit('mainfileAdded', name , key)
    }
const main_file_uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 800000000,
        maxNumberOfFiles: 1,
        allowedFileTypes: ['.zip'],
    }
})
    .use(Dashboard, {
        trigger: '#select-main-file',
    })
    //.use(Tus, {endpoint: 'http://localhost:5000/tus/', retryDelays: [0, 1000, 3000, 5000],})
    .use(AwsS3, {
        getUploadParameters (file) {
            // Send a request to our PHP signing endpoint.
            return fetch('/uppy/upload/s3', {
                method: 'post',
                // Send and receive JSON.
                headers: {
                    accept: 'application/json',
                    'content-type': 'application/json',
                },
                body: JSON.stringify({
                    filename: file.name,
                    contentType: file.type,
                }),
            }).then((response) => {
                // Parse the JSON response.
                return response.json()
            }).then((data) => {
                // Return an object in the correct shape.
                return {
                    method: data.method,
                    url: data.url,
                    fields: data.fields,
                    // Provide content type header required by S3
                    headers: {
                        'Content-Type': file.type,
                    },
                }
            })
        },
    })
main_file_uppy.on('upload-success', onMainFileUploadSuccess());

// cash_file uppy
const onCashFileUploadSuccess = () =>
    (file, response) => {
        const name = file.name;
        const key = response.uploadURL.substr(response.uploadURL.length - 26);

        Livewire.emit('cashfileAdded', name , key)
    }
const cash_file_uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 60000000,
        maxNumberOfFiles: 1,
        allowedFileTypes: ['.zip'],
    }
})
    .use(Dashboard, {
        trigger: '#select-cash-file',
        showProgressDetails: true,
        proudlyDisplayPoweredByUppy: false,
    })
    .use(AwsS3, {
        getUploadParameters (file) {

            // Send a request to our PHP signing endpoint.
            return fetch('/uppy/upload/s3', {
                method: 'post',
                // Send and receive JSON.
                headers: {
                    accept: 'application/json',
                    'content-type': 'application/json',
                },
                body: JSON.stringify({
                    filename: file.name,
                    contentType: file.type,
                }),
            }).then((response) => {
                // Parse the JSON response.
                return response.json()
            }).then((data) => {
                // Return an object in the correct shape.
                return {
                    method: data.method,
                    url: data.url,
                    fields: data.fields,
                    // Provide content type header required by S3
                    headers: {
                        'Content-Type': file.type,
                    },
                }
            })
        },
    })
cash_file_uppy.on('upload-success', onCashFileUploadSuccess());
/*cash_file_uppy.on('upload-error', (file, error, response) => {
    console.log('error with file:', file.id)
    console.log('error message:', error)
})*/

// subscribe_file uppy
const onSubscribeFileUploadSuccess = () =>
    (file, response) => {

        const name = file.name;
        const key = response.uploadURL.substr(response.uploadURL.length - 26);

        Livewire.emit('subscribefileAdded', name , key)
    }
const subscribe_file_uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 60000000,
        maxNumberOfFiles: 1,
        allowedFileTypes: ['.zip'],
    }
})
    .use(Dashboard, {
        trigger: '#select-subscribe-file',
    })
    .use(AwsS3, {
        getUploadParameters (file) {
            // Send a request to our PHP signing endpoint.
            return fetch('/uppy/upload/s3', {
                method: 'post',
                // Send and receive JSON.
                headers: {
                    accept: 'application/json',
                    'content-type': 'application/json',
                },
                body: JSON.stringify({
                    filename: file.name,
                    contentType: file.type,
                }),
            }).then((response) => {
                // Parse the JSON response.
                return response.json()
            }).then((data) => {
                // Return an object in the correct shape.
                return {
                    method: data.method,
                    url: data.url,
                    fields: data.fields,
                    // Provide content type header required by S3
                    headers: {
                        'Content-Type': file.type,
                    },
                }
            })
        },
    })
subscribe_file_uppy.on('upload-success', onSubscribeFileUploadSuccess());

// help_file uppy
const onHelpFileUploadSuccess = () =>
    (file, response) => {

        const name = file.name;
        const key = response.uploadURL.substr(response.uploadURL.length - 26);

        Livewire.emit('helpfileAdded', name , key)
    }
const help_file_uppy = new Uppy({
    locale: Iran,
    autoProceed: true,
    restrictions: {
        maxFileSize: 12000000,
        maxNumberOfFiles: 1,
        allowedFileTypes: ['.pdf'],
    }
})
    .use(Dashboard, {
        trigger: '#select-help-file',
    })
    .use(AwsS3, {
        getUploadParameters (file) {
            // Send a request to our PHP signing endpoint.
            return fetch('/uppy/upload/s3', {
                method: 'post',
                // Send and receive JSON.
                headers: {
                    accept: 'application/json',
                    'content-type': 'application/json',
                },
                body: JSON.stringify({
                    filename: file.name,
                    contentType: file.type,
                }),
            }).then((response) => {
                // Parse the JSON response.
                return response.json()
            }).then((data) => {
                // Return an object in the correct shape.
                return {
                    method: data.method,
                    url: data.url,
                    fields: data.fields,
                    // Provide content type header required by S3
                    headers: {
                        'Content-Type': file.type,
                    },
                }
            })
        },
    })
help_file_uppy.on('upload-success', onHelpFileUploadSuccess());

// Endpoint untuk memperbarui waktu terakhir update
app.post('/update-last-updated', async (req, res) => {
    const currentTime = new Date();
    await MetadataCollection.updateOne(
        { key: 'last_updated_at' },
        { $set: { value: currentTime } },
        { upsert: true }
    );
    res.send({ success: true, lastUpdated: currentTime });
});
